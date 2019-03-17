adminController
	+ bestSellers => tim cac san pham ban dc nhieu nhat
	+ notSellers  => tim cac san pham chua tung duoc ban

select products.*, sum(orders_items.quantity)
from orders_items, products
where products.product_id = orders_items.product_id
	and products.name = 'Iphone 7'

select orders_items.created_at::date, sum(orders_items.quantity)
from products,orders_items
where products.product_id = orders_items.product_id
	and products.name = 'Iphone 7'
group by orders_items.created_at::date

CREATE OR REPLACE FUNCTION tg_update_history() RETURNS trigger AS
$$DECLARE
BEGIN
if TG_OP = 'UPDATE' then
if OLD.status != NEW.status then
	if NEW.status = 2 then
	  insert into history values(OLD.id, "Đang xử lý đơn hàng"); 
	end if;
	if NEW.status = 3 then
	  insert into history values(OLD.id, "Đang ship hàng"); 
	end if;
	if NEW.status = 4 then
	  insert into history values(OLD.id, "Giao hàng thành công"); 
	end if;
	return new;
end if;
end if;
return null;
END;
$$ LANGUAGE plpgsql VOLATILE;
CREATE TRIGGER tg_change_status AFTER UPDATE
ON orders FOR EACH ROW
EXECUTE PROCEDURE tg_update_history();