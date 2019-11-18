SELECT c.id, c.l_name, c.f_name, c.nickname, email, "TRUE" AS ingroup FROM customers c, g2c WHERE c.id = g2c.user_id and g2c.group_id=2

UNION 

SELECT c.id, c.l_name, c.f_name, c.nickname, email, "FALSE" AS ingroup FROM customers c WHERE c.id NOT IN (SELECT c.id FROM customers c, g2c WHERE c.id = g2c.user_id and g2c.group_id=2)