# Archriss FAL - File Abstraction Layer improvements #

## This extension add few fields to metadata and reference ##

- Transcript field is added to metadata table
- loop field is added to reference table
- muted field is added to reference table
- force_image_render field is added to reference table
- tt_content:media field is improved with overriding child TCA for file type palette declaration
- Add arcFal:media ViewHelper in order to help generate all king of media (no more f:image vs f:media)
- Add ImageRenderer in order to externalize media handling with ou special force image render checkbox
- Register global arcFal namespace in order to use it in every templates
