<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        

        <style>
           .ok ul{list-style:none;}
           .ok li{float:left;margin-left:10px}
        </style>
    </head>
    <body>
        <div class="container">
            <div class="ok">
                {!!$rac_order_arr->appends(['pixel'=>'1'])->render() !!}
            </div>

        </div>
    </body>
<script>
    window.onload = function () {
        obj = document.getElementById("test").getElementsByTagName("li");
        obj.innerHtml = "ok";

    }
</script>
</html>
