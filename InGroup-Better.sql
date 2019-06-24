SELECT DISTINCT c.id, c.l_name, c.f_name, c.nickname, c.email, IF(ISNULL(g2c.customer_id)=0 ,"TRUE","FALSE") AS ingroup 
FROM customers c
LEFT JOIN g2c ON c.id = g2c.customer_id AND g2c.group_id=2 ORDER BY ingroup DESC, f_name ASC;
