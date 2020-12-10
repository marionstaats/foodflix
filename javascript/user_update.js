const updateForm = document.getElementById('update-form');

// display update field
document.getElementById('update-btn').addEventListener('click', () => {
  updateForm.classList.remove('hide');
});

// close update field
document.getElementById('close_window').addEventListener('click', () => {
  updateForm.classList.add('hide');
});