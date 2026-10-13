See README.md

For the local dev env:

- Do not assume DDEV is being used.
- Check .env to determine the current setup.
- An active `npm run dev` may already be automatically updating build files.

When making changes to the Craft CMS data model:

- Never edit files inside ./config/project/ directly.
- Invoke Craft APIs directly via PHP (or other means) to make changes to the data model.
