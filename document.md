Please refer bellow code is perfectly done and tested design change,list changes all done in that
please use same way to use for other.

app\Http\Controllers\BlogController.php
resources\views\admin\blogs\create.blade.php
resources\views\admin\blogs\index.blade.php
resources\views\admin\blogs\edit.blade.php
resources\views\admin\blogs\view.blade.php

###############
need to update
step 1:
app\Http\Controllers\ProductController.php

resources\views\admin\blogs\create.blade.php
resources\views\admin\blogs\index.blade.php
resources\views\admin\blogs\edit.blade.php
resources\views\admin\blogs\view.blade.php

step 2:
app\Http\Controllers\BlogCategoryController.php
resources\views\admin\blog_categories\create.blade.php
resources\views\admin\blog_categories\index.blade.php
resources\views\admin\blog_categories\edit.blade.php
resources\views\admin\blog_categories\view.blade.php

step 3:
app\Http\Controllers\BlogCommentController.php
resources\views\admin\blog_comments\create.blade.php
resources\views\admin\blog_comments\index.blade.php
resources\views\admin\blog_comments\edit.blade.php
resources\views\admin\blog_comments\view.blade.php

step 4:
app\Http\Controllers\CompanyPageController.php
resources\views\admin\company_pages\create.blade.php
resources\views\admin\company_pages\index.blade.php
resources\views\admin\company_pages\edit.blade.php
resources\views\admin\company_pages\view.blade.php

step 5:
app\Http\Controllers\ContactController.php
resources\views\admin\contacts\create.blade.php
resources\views\admin\contacts\index.blade.php
resources\views\admin\contacts\edit.blade.php
resources\views\admin\contacts\view.blade.php

step 6
Inned Design for
Menu management:
every thing in on view screen
create menu with title,link,sequence
i can moved menu to top or boutoom place then so sequence
i can bale to make number of time nested menu

step 7
Please check menus table DB & model & controller
\*\* I need you create seeder as per my frontend top menu  
file from frontend
frontend\index.html

step 8
Please check blog table DB & model & controller
I need you create seeder as per my frontend blog & blogs-single.html
creat seed fro blogs,blog_category,blog_comment,blog_tags,pivot_blog_tags(blog_tags,pivot_blog_tags both need to create table also)
(blog detail page)

frontend\blogs.html
frontend\blogs-single.html

$blog_categories = [
['name' => 'Plumbing & Sewage'],
['name' => 'Agriculture'],
['name' => 'Borewell', ],
['name' => 'HDPE Pipes', ],
['name' => 'Marina Tank', ],
['name' => 'Bath Fittings'],
];
blog_tag=> [
'Skipper Pipes',
'Environmental',
'Sustainable',
'Pipe Manufacturer',
'Polymer pipes',
];

step 9
Please check compnay_pages table DB & model & controller
I need you create seeder as per my frontend htmls
creat seed fro compnay_pages
and you get title for compnay_pages(from menu) from html
but i dont have data so you make dummy data for that

step 10
Please check product table DB & model & controller
I need you create seeder as per my frontend product-single.html
create seed fro product
and you get title for product (from menu) from html
but i don't have data so you make dummy data for that

step 11
i forget bwllow thing in blog,product,company_page
Meta Title(not required)
Meta Description(not required)
Meta Keywords(not required)

please update in same table migartion and same sedder not make new migartion for that

step 12
i forget bellow thing in blog,product,company_page
Meta Title(not required)
Meta Description(not required)
Meta Keywords(not required)
you need to update in model & controller

step 12.1
i forget bellow thing in blog,product,company_page
Meta Title(not required)
Meta Description(not required)
Meta Keywords(not required)
you need to update create & edit view pages

step 12.2
create new migartion for banner
colunm id,title,image,sequence,link

step 12.3
create controller,model,migartion

step 12.4
create index,creat,edit,view baldes or in last please add in left side menu `banner`
