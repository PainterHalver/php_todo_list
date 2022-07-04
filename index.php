<?php
session_start();
require_once("views/template/header.php");
?>

<!-- Add Button -->
<button type='button' class='btn btn-primary align-self-end mb-2' data-bs-toggle="modal" data-bs-target='#addModal'>+ Add Note</button>
<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Note</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="includes/add-note.php" method='POST' id='add-form'>
                    <div class="mb-3">
                        <label for="noteTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="noteTitle" name='noteTitle'>
                        <div class="form-text">Please do not try to SQL inject my fragile database. :(</div>
                    </div>
                    <div class="mb-3">
                        <label for="noteBody" class="form-label">Body</label>
                        <textarea type="text" class="form-control" id="noteBody" rows="3" name="noteBody"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form='add-form' value="Submit" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>
<!-- Delete Modal -->
<div class="modal fade" id='deleteModal' tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Note</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Do you really want to delete this note?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Nah</button>
                <button type="button" class="btn__confirm-delete btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Note</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="includes/edit-note.php" method='POST' id='edit-form'>
                    <input type="text" name="noteId" class="d-none form-control">
                    <div class="mb-3">
                        <label for="noteTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="noteTitle" name='noteTitle'>
                        <div class="form-text">Please do not try to SQL inject my fragile database. :(</div>
                    </div>
                    <div class="mb-3">
                        <label for="noteBody" class="form-label">Body</label>
                        <textarea type="text" class="form-control" id="noteBody" rows="3" name="noteBody"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form='edit-form' value="Submit" class="btn btn-primary">Edit</button>
            </div>
        </div>
    </div>
</div>


<table class="table table-striped table-bordered table-todo">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Title</th>
            <th scope="col">Time</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $db = new SQLite3("todo.db");
        $result = $db->query("SELECT * FROM todos WHERE completed = 0 AND deleted = 0 ORDER BY createdAt DESC");
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $body = $row['body'] !== "" ? $row['body'] : 'Empty content!';
            echo "<tr>";
            echo "<th style='width:4%;'>" . $row['id'] . "</th>";
            echo "<td><a href='#id-{$row['id']}' style='text-decoration:none;' data-bs-toggle='collapse' role='button'>{$row['title']}</a></td>";
            echo "<td style='width:1%;white-space:nowrap;'>" . $row['createdAt'] . "</td>";
            echo "<td style='width:1%;white-space:nowrap;'> 
                            <button type='button' class='btn btn-success btn-sm btn-complete' data-note-id='{$row['id']}'>Complete</button>
                            <button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#deleteModal' data-note-id='{$row['id']}'>Delete</button>
                            <button type='button' class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#editModal' data-note-id='{$row['id']}' data-title='{$row['title']}' data-body='{$row['body']}'>Edit</button>
                        </td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td colspan='4' style='padding:0 !important;'>
                            <div class='collapse' id='id-{$row['id']}'><p class='px-2 pt-2'>{$body}</p></div>
                        </td>";
            echo "</tr>";
        };
        ?>
    </tbody>
</table>


<button class="btn btn-primary btn__completed-toggle align-self-end mb-2">Toggle Completed</button>

<table class="table table-striped table-bordered table-completed">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Title</th>
            <th scope="col">Time</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $db = new SQLite3("todo.db");
        $result = $db->query("SELECT * FROM todos WHERE completed = 1 AND deleted = 0 ORDER BY createdAt DESC");
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $body = $row['body'] !== "" ? $row['body'] : 'Empty content!';
            echo "<tr>";
            echo "<th style='width:4%;'>" . $row['id'] . "</th>";
            echo "<td><a href='#id-{$row['id']}' style='text-decoration:none;' data-bs-toggle='collapse' role='button'>{$row['title']}</a></td>";
            echo "<td style='width:1%;white-space:nowrap;'>" . $row['createdAt'] . "</td>";
            echo "<td style='width:1%;white-space:nowrap;'> 
                            <button type='button' class='btn btn-success btn-sm btn-complete' data-note-id='{$row['id']}'>&nbsp&nbsp Undo &nbsp&nbsp&nbsp</button>
                            <button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#deleteModal' data-note-id='{$row['id']}'>Delete</button>
                            <button type='button' class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#editModal' data-note-id='{$row['id']}' data-title='{$row['title']}' data-body='{$row['body']}'>Edit</button>
                        </td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td colspan='4' style='padding:0 !important;'>
                            <div class='collapse' id='id-{$row['id']}'><p class='px-2 pt-2'>{$body}</p></div>
                        </td>";
            echo "</tr>";
        };
        ?>
    </tbody>
</table>

<script src="assets/js/index.js"></script>

<?php require_once("views/template/footer.php") ?>