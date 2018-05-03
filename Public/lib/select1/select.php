<!DOCTYPE html>  
<html>  
<head>  

    <script type="text/javascript" src="./jquery.js"></script>  
    <script type="text/javascript" src="./bootstrap-select.js"></script>    
    <link rel="stylesheet" href="./bootstrap-select.css">    
    <link href="./bootstrap.min.css" rel="stylesheet">  
    <script src="./bootstrap.min.js"></script>  
    <script type="text/javascript">  
        $(window).on('load', function () {  
            $('.selectpicker').selectpicker({  
                'selectedText': 'cat'  
            });  
        });  
    </script>  
</head>  
<body>  

    <div class="container" style="margin-top:15px;">  
        <form class="form-horizontal" role="form">  
            <div class="form-group">  
                <label for="bs3Select" class="col-lg-2 control-label">选择客户</label>  
                <div class="col-lg-10">  
                    <!--<select id="bs3Select" class="selectpicker show-tick form-control" multiple data-live-search="true">-->
                    <select id="bs3Select" class="selectpicker show-tick form-control" data-live-search="true">  
                        <option>11</option>   
                        <option>12</option>   
                        <option>13</option>   
                        <option>21</option>   
                        <option>22</option>   
                        <option>23</option>   
                        <option>33</option>   
                        <option>34</option>   
                        <option value="35" selected>35</option>   
                    </select>  
                </div>  
              </div>  
        <form>  
    </div>  
  
</body>  
</html>  






