import { Plugin } from 'ckeditor5';

const NBSP = String.fromCharCode(0xa0);

/**
 * Highlights non-breaking spaces in the editing view.
 * Markers don't affect the editor's data or undo history.
 */
export class NbspHighlight extends Plugin {
  static get pluginName() {
    return 'NbspHighlight';
  }

  init() {
    const editor = this.editor;
    const model = editor.model;
    const key = (position) => `${position.root.rootName}:${position.path}`;
    let counter = 0;

    editor.conversion.for('editingDowncast').markerToHighlight({
      model: 'nbsp',
      view: { classes: 'ck-nbsp' },
    });

    model.document.registerPostFixer((writer) => {
      const found = [];
      let removed = false;

      // Find nbsp characters in newly inserted content
      for (const change of model.document.differ.getChanges()) {
        if (change.type === 'remove') {
          removed = true;
        } else if (change.type === 'insert') {
          const { position, length, name } = change;
          const range =
            name === '$text'
              ? model.createRange(position, position.getShiftedBy(length))
              : position.nodeAfter && model.createRangeOn(position.nodeAfter);
          for (const { item } of range ?? []) {
            if (!item.is('$textProxy')) {
              continue;
            }
            for (
              let i = item.data.indexOf(NBSP);
              i !== -1;
              i = item.data.indexOf(NBSP, i + 1)
            ) {
              found.push(
                model.createPositionAt(item.parent, item.startOffset + i),
              );
            }
          }
        }
      }

      if (!removed && !found.length) {
        return false;
      }

      // A marker collapses when its nbsp is deleted, and moves to the graveyard with removed content
      const taken = new Set();
      for (const marker of [...model.markers.getMarkersGroup('nbsp')]) {
        const range = marker.getRange();
        if (
          removed &&
          (range.isCollapsed || range.root.rootName === '$graveyard')
        ) {
          writer.removeMarker(marker);
        } else if (found.length) {
          taken.add(key(range.start));
        }
      }

      for (const start of found) {
        if (!taken.has(key(start))) {
          taken.add(key(start));
          writer.addMarker(`nbsp:${counter++}`, {
            range: model.createRange(start, start.getShiftedBy(1)),
            usingOperation: false,
            affectsData: false,
          });
        }
      }

      return false;
    });
  }
}
