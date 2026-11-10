See README.md

For the local dev env:

- Do not assume DDEV is being used.
- Check .env to determine the current setup.
- An active `npm run dev` may already be automatically updating build files.

When making changes to the Craft CMS data model:

- Never edit files inside ./config/project/ directly.
- Invoke Craft APIs directly via PHP (or other means) to make changes to the data model.

When writing Twig templates (especially `_views/details/*`):

- Read field data only in the Params section, into overridable `detail*` vars (`{% set detailIntro = detailIntro ?? entry.introduction ?? null %}`). Render blocks use those vars, never `entry.*` directly.
- Build shared features (intro, footer, published date, body profile) into `_default` behind params. Child views set params and override `*_class` blocks.
- Override the narrowest block that does the job (e.g. `detail_body_blocks`, not `detail_body`). Re-implement `detail_layout` only when the structure really differs.
- Every styled element gets one `{block}_class` hook named after its block (`detail_body_text` → `detail_body_text_class`). Don't split it into partial hooks like `_padding_class`.
- Define a block inline where it renders. Don't define it elsewhere and pull it in with `block()`.
- Render an optional wrapper (e.g. `<footer>`) only when its inner block's output is non-empty. Don't hide or restyle an empty wrapper with conditional classes.
- Write long class lists as arrays grouped by concern (spacing/layout, colour, CSS vars), passed through `|join(' ')` or `attr()`. Class maps hold arrays and are merged with `...`.
- Use existing type utilities (e.g. `prose-meta`, `title-h1`) instead of ad-hoc font/opacity combos.
- Skip defensive fallbacks for values that can't be null (`?: []` after `.all()`).
- Keep comments sparse: section headers (`{# Params #}`, `{# Layout #}`, `{# Render #}`) and short notes only, no prose explaining design.
- No Twig comments inside a Twig tag (both `{{ }}` and `{% %}`).

When testing URLs:

- Only use the Chrome plugin if the tests are visual in nature. Avoid capturing screenshots in cases where inspecting the rendered HTML markup might be sufficient.

When seeding content to the CMS:

- If this is a multi-site project, add content (undertaking translations to different languages based on the site's language, where needed) for fields that are translatable, using the English site's content as the primary source.
