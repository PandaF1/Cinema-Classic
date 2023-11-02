//валидация и вывод поля с изображением
const fileUploader = document.getElementById('file-uploader');
const feedback = document.getElementById('feedback');

fileUploader.addEventListener('change', (event) => {
  const file = event.target.files[0];
  console.log('file', file);
  console.log('file', file.name);

  const size = file.size;
  console.log('size', size);
  let msg = '';

  if (size > 1024 * 1024) {
    msg = `<span style="color:#e74c3c;">The allowed file size is 1MB. The file you are trying to upload is of ${returnFileSize(size)}</span>`;
    document.getElementById("file-uploader").value = "";
  } else {
    msg = `<span style="color:seagreen;"> A ${returnFileSize(size)} file has been uploaded successfully. </span>`;
    $("#targf").text(file.name);
    $(".btn").addClass("first");
  }
  feedback.innerHTML = msg;
});

function returnFileSize(number) {
  if(number < 1024) {
    return number + 'bytes';
  } else if(number >= 1024 && number < 1048576) {
    return (number/1024).toFixed(2) + 'KB';
  } else if(number >= 1048576) {
    return (number/1048576).toFixed(2) + 'MB';
  }
}