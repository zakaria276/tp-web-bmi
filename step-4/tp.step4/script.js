$(document).ready(function() {
    $('#bmiForm').submit(function(event) {
        event.preventDefault();

        $.ajax({
            url: 'calculate.php',
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#result').html(`<div class="alert alert-success">${response.message}</div>`);
                } else {
                    $('#result').html(`<div class="alert alert-danger">${response.message}</div>`);
                }
            },
            error: function(xhr, status, error) {
                $('#result').html(`<div class="alert alert-danger">An error occurred: ${error}</div>`);
            }
        });
    });
});