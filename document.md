please take refrence of bellow page
resources\views\admin\home-page\index.blade.php

1 Make migartion
2 make model
3 Make control from production section part (every methde get product id) because we redired on our this page from prduct list
4)Creta vew make some data need ot daynmic (tab 3 , tab 4)

tab 1
production_overview_section
product_id
overview_descrition
overview_image(json) (multiple image upload)

tab 2
production_application_section
product_id
icon
title
description
tab 3
production_features_section
product_id
product_id
image
icon
title
description

tab 4
production_faq_section
product_id
title
description

Migrations and Models for:
production_overview_section (Tab 1)Yes
production_application_section (Tab 2)Yes
production_features_section (Tab 3)Yes
production_faq_section (Tab 4)Yes
A controller that handles all these sections, with methods getting product_id as a parameter Yes
Views similar to home-page/index.blade.php structure but with these 4 tabs
Before I proceed, I need to clarify a few things:
For Tab 1's overview_image field which is JSON for multiple images:
Do you want a limit on how many images can be uploaded?limit 5
Should there be any specific image dimensions or size restrictions?image size 2 mb
For Tab 2's application section:
Should the icon be an uploaded image or a FontAwesome icon selection?not it's text box we just give "class name in that"
Can there be multiple application entries for a single product?Yes
For Tab 3's features section:
I notice there are two product_id fields in the document. Is this a typo?oh is my mistake i copy two time
Should both image and icon be supported, or is this a typo? image file upload & icon label has text box
Can there be multiple feature entries for a single product?yes because its featur & benifit part that well be multi pal
For Tab 4's FAQ section:
Can there be multiple FAQ entries for a single product?yes it's multipel
