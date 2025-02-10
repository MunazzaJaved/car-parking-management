When you click a link or button with a URL like update-slot.php?id=5&status=available, the values are passed in 
the URL as query parameters, which are then accessed via $_GET['id'] and $_GET['status'].

:status and :slot_id:
Named Placeholders: They help prevent SQL injection attacks by automatically escaping the values before inserting
 them into the query. ? (positional placeholders) are both used in prepared statements.