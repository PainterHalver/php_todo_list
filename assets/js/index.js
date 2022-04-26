/**
 * Complete Toggle Handlers
 */
// Event bubbling and capturing
// https://stackoverflow.com/questions/49680484/how-to-add-one-event-listener-for-all-buttons
const todoTable = document.querySelector(".table-todo");
todoTable.addEventListener("click", async (e) => {
  const isCompleteButton = e.target.classList.contains("btn-complete");

  if (isCompleteButton) {
    const noteId = e.target.getAttribute("data-note-id");
    const res = await fetch(`includes/complete-note.php`, {
      method: "POST",
      body: JSON.stringify({ noteId: noteId }),
    });

    if (res.ok) {
      location.reload();
    }
  }
});

const completedTable = document.querySelector(".table-completed");
completedTable.addEventListener("click", async (e) => {
  const isCompleteButton = e.target.classList.contains("btn-complete");

  if (isCompleteButton) {
    const noteId = e.target.getAttribute("data-note-id");
    const res = await fetch(`includes/complete-note.php`, {
      method: "POST",
      body: JSON.stringify({ noteId: noteId }),
    });

    if (res.ok) {
      location.reload();
    }
  }
});

/**
 * Delete Modal
 */
const deleteModal = document.getElementById("deleteModal");

deleteModal.addEventListener("show.bs.modal", (e) => {
  const button = e.relatedTarget;
  const noteId = button.getAttribute("data-note-id");

  console.log(noteId);

  const confirmDeleteButton = document.querySelector(".btn__confirm-delete");

  confirmDeleteButton.addEventListener("click", async () => {
    const res = await fetch(`includes/delete-note.php?noteId=${noteId}`, {
      method: "DELETE",
    });

    if (res.ok) {
      location.reload();
    }
  });
});

/**
 * Edit Modal
 */
const editModal = document.getElementById("editModal");

editModal.addEventListener("show.bs.modal", (e) => {
  const button = e.relatedTarget;
  const noteId = button.getAttribute("data-note-id");
  const title = button.getAttribute("data-title");
  const body = button.getAttribute("data-body");

  editModal.querySelectorAll(".form-control")[0].value = noteId;
  editModal.querySelectorAll(".form-control")[1].value = title;
  editModal.querySelectorAll(".form-control")[2].value = body;
});

/**
 * Completed Table Toggle
 */
const completedToggleButton = document.querySelector(".btn__completed-toggle");
completedToggleButton.addEventListener("click", () => {
  const completedTable = document.querySelector(".table-completed");
  completedTable.style.display =
    completedTable.style.display === "none" ? "block" : "none";
});
