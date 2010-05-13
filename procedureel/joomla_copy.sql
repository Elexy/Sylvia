DELETE FROM joomla.jos_categories
WHERE id > 1000 AND id < 2000;    

INSERT INTO joomla.jos_categories (
    id,
    title,
    name,
    section,
    image_position,
    published
    )
SELECT DISTINCT
    categories.CategoryID+1000,
    CategoryName,
    CategoryName,
    '1',
    'left',
    '1'
FROM iwex.categories
INNER JOIN iwex.current_product_list ON 
	iwex.categories.CategoryID = iwex.current_product_list.CategoryID	
INNER JOIN iwex.listbox ON listbox.category = '10' AND
	iwex.listbox.value = iwex.current_product_list.image
	WHERE iwex.current_product_list.public 
          AND iwex.current_product_list.MerkID = 88;

ALTER TABLE joomla.jos_categories AUTO_INCREMENT = 3000;

DELETE FROM joomla.jos_menu
WHERE id > 1000 AND id < 2000;    

INSERT INTO joomla.jos_menu (
    id,
    menutype,
    name,
    link,
    type,
    published,
    parent,
    params
    )
SELECT DISTINCT
    categories.CategoryID+1000,
    'topmenu',
    CategoryName,
    CONCAT('index.php?option=com_content&task=blogcategory&id=', categories.CategoryID+1000),
    'content_blog_category',
    '1',
    '3',
    'menu_image=-1
pageclass_sfx=
back_button=
header=
page_title=1
leading=1
intro=4
columns=1
link=5
orderby_pri=
orderby_sec=
pagination=2
pagination_results=1
image=1
description=0
description_image=0
category=0
category_link=0
item_title=1
link_titles=
readmore=
rating=
author=
createdate=
modifydate=
pdf=
print=
email=
categoryid='
FROM iwex.categories
INNER JOIN iwex.current_product_list ON 
	iwex.categories.CategoryID = iwex.current_product_list.CategoryID	
INNER JOIN iwex.listbox ON listbox.category = '10' AND
	iwex.listbox.value = iwex.current_product_list.image
	WHERE iwex.current_product_list.public 
          AND iwex.current_product_list.MerkID = 88;

ALTER TABLE joomla.jos_menu AUTO_INCREMENT = 3000;

DELETE FROM joomla.jos_content
WHERE id > '1000' AND id < '90000'; 

Insert into joomla.jos_content (
    id,
    title, 
    introtext, 
    state,
    sectionid,
    catid,
    created,
    created_by,
    publish_up,
    images
    ) 
SELECT 
    ProductID-990000,
    ProductName, 
    CONCAT('<div align="left"><table border="0"><tbody><tr><td>&nbsp;{mosimage}</td><td>', 
           Productdescription, 
           '</td></tr></tbody></table></div>'),
    '1',
    '1',
    CategoryID+1000,
    NOW(),
    '62',
    '2006-01-01 00:00:00',
    CONCAT('keomo_products/', ProductID, '.', text)
FROM iwex.current_product_list
INNER JOIN iwex.listbox ON listbox.category = '10' AND
	iwex.listbox.value = iwex.current_product_list.image
  WHERE iwex.current_product_list.MerkID = 88
        AND iwex.current_product_list.public;
    
ALTER TABLE joomla.jos_content AUTO_INCREMENT = 90000;
