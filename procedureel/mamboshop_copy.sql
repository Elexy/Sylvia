DELETE FROM mambo.mos_pshop_product ; 
#WHERE product_id > '20';

Insert into mambo.mos_pshop_product (
    product_id,
    product_sku, 
    product_s_desc, 
    product_desc, 
    product_thumb_image, 
    product_full_image,
    product_publish,
    product_name,
    vendor_id,
    product_special
    ) 
SELECT 
    ProductID,
    ProductID, 
    ProductName, 
    Productdescription, 
    concat(ProductID,".",listbox.text), 
    concat(ProductID,".",listbox.text), 
    'Y',
    ProductName,
    '1',
    IF(special,"Y", "N")
FROM iwex.current_product_list
INNER JOIN iwex.listbox ON listbox.category = '10' AND
	iwex.listbox.value = iwex.current_product_list.image
  WHERE iwex.current_product_list.public=1;

DELETE FROM mambo.mos_pshop_category;

INSERT INTO mambo.mos_pshop_category (
    category_id,
    vendor_id,
    category_name,
    category_description,
    category_publish,
    products_per_row,
    list_order,
    category_browsepage
    )
SELECT DISTINCT
    categories.CategoryID,
    '1',
    CategoryName,
    CategoryName,
    'Y',
    '2',
    categories.CategoryID,
    'browse_iwex'
FROM iwex.categories
INNER JOIN iwex.current_product_list ON 
	iwex.categories.CategoryID = iwex.current_product_list.CategoryID	
INNER JOIN iwex.listbox ON listbox.category = '10' AND
	iwex.listbox.value = iwex.current_product_list.image
  	WHERE iwex.current_product_list.public=1;

DELETE FROM mambo.mos_pshop_product_category_xref ;
#WHERE product_id > '10';

INSERT INTO mambo.mos_pshop_product_category_xref (
    category_id,
    product_id
    )
SELECT 
    current_product_list.CategoryID,
    current_product_list.ProductID
FROM iwex.current_product_list
  	WHERE iwex.current_product_list.public=1;
    
DELETE FROM mambo.mos_pshop_category_xref ;
#WHERE 
#    category_parent_id <> '1c914424d2569bea3439fbcca9123a27' AND
#    category_child_id <> '541a03b2b0e1b6dbd972e9f5af5ca992' AND
#    category_child_id <> '1c914424d2569bea3439fbcca9123a27' AND
#    category_child_id <> '6834dda8e3e6e5aa18bafc63a57fd04a';

INSERT INTO mambo.mos_pshop_category_xref (
    category_parent_id,
    category_child_id
    )
SELECT DISTINCT
    '0',
    current_product_list.CategoryID
FROM iwex.categories
INNER JOIN iwex.current_product_list ON iwex.categories.CategoryID = iwex.current_product_list.CategoryID
  WHERE iwex.current_product_list.public=1;

DELETE FROM mambo.mos_pshop_manufacturer;

INSERT INTO mambo.mos_pshop_manufacturer (
	manufacturer_id,
	mf_name
  )
SELECT DISTINCT
  brand_id,
	name
FROM iwex.brand
INNER JOIN iwex.current_product_list ON iwex.brand.brand_id = iwex.current_product_list.MerkID
  WHERE iwex.current_product_list.public=1;

DELETE FROM mambo.mos_pshop_product_mf_xref ;

INSERT INTO mambo.mos_pshop_product_mf_xref (
    product_id,
    manufacturer_id
    )
SELECT DISTINCT
    current_product_list.ProductID,
    brand_id
FROM iwex.brand
INNER JOIN iwex.current_product_list ON iwex.brand.brand_id = iwex.current_product_list.MerkID
INNER JOIN iwex.listbox ON listbox.category = '10' AND
	iwex.listbox.value = iwex.current_product_list.image
  WHERE iwex.current_product_list.public=1;


