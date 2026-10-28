-- SQL commands to reset demo data

-- 1. Delete all bookings and related pivot & invoice data
DELETE FROM booking_unit;
DELETE FROM invoices;
DELETE FROM bookings;

-- 2. Reset units to 20 active per item
-- First delete any units above 20 for each item
DELETE u FROM units u
    JOIN (
        SELECT item_id, MIN(id) AS keep_id, COUNT(*) AS cnt
        FROM units
        WHERE status = 'active'
        GROUP BY item_id
    ) e ON u.item_id = e.item_id
    WHERE u.status = 'active' AND u.id != e.keep_id
    ORDER BY u.item_id, u.id
    LIMIT 0;

-- Then ensure each item has exactly 20 active units
-- Drop all existing units for simplicity
DELETE FROM units;

INSERT INTO units (item_id, serial_no, status, created_at, updated_at)
SELECT id AS item_id, CONCAT('SN-', LPAD(id, 4, '0'), '-', LPAD(seq, 4, '0')) AS serial_no, 'active', NOW(), NOW()
FROM items
JOIN (
    SELECT @row := @row + 1 AS seq FROM (SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL SELECT 11 UNION ALL SELECT 12 UNION ALL SELECT 13 UNION ALL SELECT 14 UNION ALL SELECT 15 UNION ALL SELECT 16 UNION ALL SELECT 17 UNION ALL SELECT 18 UNION ALL SELECT 19 UNION ALL SELECT 20) t
) seqs,
(SELECT @row := 0) r;

COMMIT;
