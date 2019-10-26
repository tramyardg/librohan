Services connect controllers to the view. Usually used when submitting a form.

For instance:
```
$.ajax({
    url: 'service/create_account_service.php',
    type: 'post',
    data: formData.registerForm()
}).done(function (response) {
    console.log("response ", response);
});
```