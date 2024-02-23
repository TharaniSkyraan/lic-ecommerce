<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>License Installation</title>
    <!---Custom CSS File--->
    <style>
      /* Import Google font - Poppins */
      @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
      }
      body {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: rgb(130, 106, 251);
      }
      .container {
        position: relative;
        max-width: 700px;
        width: 100%;
        background: #fff;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      }
      .container header {
        font-size: 1.5rem;
        color: #333;
        font-weight: 500;
        text-align: center;
      }
      .container .form {
        margin-top: 30px;
      }
      .form .input-box {
        width: 100%;
        margin-top: 20px;
      }
      .input-box label {
        color: #333;
      }
      .form :where(.input-box input, .select-box) {
        position: relative;
        height: 50px;
        width: 100%;
        outline: none;
        font-size: 1rem;
        color: #707070;
        margin-top: 8px;
        border: 1px solid #ddd;
        border-radius: 6px;
        padding: 0 15px;
      }
      .input-box input:focus {
        box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
      }
      .form button {
        height: 55px;
        width: 100%;
        color: #fff;
        font-size: 1rem;
        font-weight: 400;
        margin-top: 30px;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        background: rgb(130, 106, 251);
      }
      .form button:hover {
        background: rgb(88, 56, 250);
      }
      .err_msg{
        color:red;
      }
      </style>
  </head>
  <body>
    <section class="container">
      <header>License Installation</header>
      <form action="{{ route('installlic') }}" method="post" class="form" id="installlic">
          <!-- CSRF Token -->
          <!-- @csrf -->
        <div class="input-box">
          <label>User Name</label>
          <input type="text" name="user_name" id="user_name" placeholder="Enter User name" />
          <span id="err_user_name" class="err_msg"></span>
        </div>

        <div class="input-box">
          <label>Product Key</label>
          <input type="text" name="product_key" id="product_key" placeholder="Enter License Key" />
          <span id="err_product_key" class="err_msg"></span>
        </div>

        <div class="input-box">
          <label>License Key</label>
          <input type="text" name="license_key" id="license_key" placeholder="Enter License Key" />
          <span id="err_license_key" class="err_msg"></span>
        </div>

        <button button="submit" id="submit">Submit</button>
      </form>
    </section>
  </body>
</html>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>

$('#submit').on('click', function (e) {
    var form = $('#installlic');   
    $.ajax({
        url     : form.attr('action'),
        type    : form.attr('method'),
        data    : form.serialize(),
        dataType: 'json',
        success : function (json){  
          window.location.href = "{{ url('/') }}";
        },
        error: function(json){
          $('.err_msg').html('');  
          if (json.status === 422) {
            var resJSON = json.responseJSON;
              $.each(resJSON.errors, function (key, value) {    
                $('#err_'+key).html(value[0]);               
              });
          }

        }
    });
    return false;
});
</script>