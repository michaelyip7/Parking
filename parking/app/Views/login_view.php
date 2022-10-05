<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            min-height: 100vh;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-4 offset-4 border border-secondary" style="margin-top:20px">
                <h1 style="text-align:center">Login</h1>
                <form method="post">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                    </div>

                    <div>
                        <input name="btnSubmit" type="submit" class="btn btn-primary" value="Submit" style="margin-bottom:30px;" />
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>