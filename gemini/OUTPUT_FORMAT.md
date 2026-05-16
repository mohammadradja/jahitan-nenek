# 📝 OUTPUT FORMAT

## API Response Standard
All internal API responses (AJAX) should follow this JSON format:

```json
{
    "success": true,
    "message": "Operation completed successfully",
    "data": { ... },
    "errors": null
}
```

## Data Formatting
- **Currency**: `Rp{number_format($value, 0, ',', '.')}`
- **Dates**: `d M Y` (e.g., 16 May 2026)
- **Status Pills**: Uppercase tracking-widest with role-based colors.

## Documentation Structure (Gemini)
All documentation in the `gemini/` directory must:
- Use **UPPERCASE** for filenames.
- Use **GitHub Flavored Markdown**.
- Include emojis in headers for visual organization.
- Be updated as soon as a feature is completed or a major architectural decision is made.

## Export Standards
- **CSV**: UTF-8 encoding, comma-separated, includes headers.
- **PDF**: Printable HTML view, landscape/portrait as needed, optimized for browser print-to-pdf.
