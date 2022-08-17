<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Add Product</title>

    <!-- Bootstrap CDN Link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        h1{
            background: green;
            color: white;
            text-align: center;
            padding: 5px 0px;
            font-size: 20px;
        }
        h5{
            text-align: center;
        }
    </style>
</head>
<body>
    
    <div class="mx-2">
        <div class="row mt-1">
            <div class="col-md-4">
                <div class="msg">

                </div>
                    <div class="mt-2 form-group">
                        <label for="fName">First Name</label>
                        <input type="text" id="fName" class="fName form-control">
                    </div>
                    <div class="mt-2 form-group">
                        <label for="lName">Last Name</label>
                        <input type="text" id="lName" class="lName form-control">
                    </div>
                    <div class="mt-2 form-group">
                        <label for="address">Address</label>
                        <!-- <input type="text" id="address" class="address form-control"> -->
                        <textarea class="address form-control" id="address" cols="30" rows="3"></textarea>
                    </div>
                    <div class="mt-2 form-group">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" class="phone form-control">
                    </div>
                    <div class="mt-2 form-group">
                        <label for="email">Email</label>
                        <input type="text" id="email" class="email form-control">
                    </div>
                    <div class="mt-2 form-group">
                        <label for="status">Employee Status</label>
                        <select name="status" id="status" class="status form-control">
                            <option value="0">------------Select Status----------</option>
                            <option value="1">Present</option>
                            <option value="0">Absent</option>
                        </select>
                    </div>
                    <div class="mt-3 form-group">
                        <button id="save" class="save btn btn-success form-control">Save</button>
                    </div>
            </div>
            <div class="col-md-8">
                <caption><h5>Employee Data</h5></caption>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#sl No</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="alldata">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <script>
        jQuery(document).ready(function(){
            show();
            function show(){
                $.ajax({
                    url: 'showemployee',
                    type: 'GET',
                    datatype: 'JSON',
                    succeess:function(result){
                        if(result.status == "success"){
                            $.each(result.alldata, function(key, item){
                                jQuery(".alldata").append('<tr><td>' + item.fName + '</td></tr>');
                            });
                                
                            
                        }
                        else if(result.status == "404"){
                            alert("Error 404 ! Data not Found");
                        }
                    }
                });
            }


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery(".save").click(function(){
                var fName = jQuery(".fName").val();
                var lName = jQuery(".lName").val();
                var address = jQuery(".address").val();
                var phone = jQuery(".phone").val();
                var email = jQuery(".email").val();
                var status = jQuery(".status").val();

                $.ajax({
                    url: 'storeemployee',
                    type: 'POST',
                    datatype: 'JSON',
                    data:{
                        fName: fName,
                        lName: lName,
                        address: address,
                        phone: phone,
                        email: email,
                        status: status
                    },
                    success:function(result){
                        if(result["msg"] == "404"){
                            jQuery(".msg").html('<div class="alert alert-danger">Faield</div>');
                            jQuery(".msg").fadeOut(2000);
                        }
                        else if(result["msg"] == "success"){
                            show();
                            jQuery(".msg").html('<div class="alert alert-success">Successfully Done</div>');
                            jQuery(".msg").fadeOut(2000);
                        }
                    }
                });
            })
        });
    </script>

    

</body>
</html>
