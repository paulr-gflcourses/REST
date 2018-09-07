<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">

        <title><?php echo TITLE ?></title>
        <link href="html/css/bootstrap.min.css" rel="stylesheet">
        <link href="html/css/my.css" rel="stylesheet">

    </head>
    <body>

        <div class="container">
            <h1>Car Service<small> (SOAP) </small></h1>

            <form name="carform" id="carform" action="javascript:void(0);">
                <div class="form-group ">
                    <button type="submit" class="btn btn-success"
                                          onclick="getCarList()">Get all cars list</button>
                </div>
            </form>

            <form name="filterform" id="filterform" action="javascript:void(0);">
                <div class="form-group row">
                    <div class="col-lg-4">
                        <h3>Filter options</h3>
                        <button type="submit" class="btn btn-success"
                                              onclick="searchCars()">Search</button>
                        <div class="input-group">
                            <span class="input-group-addon">
                                Mark
                            </span>
                            <select class="form-control" name="mark" id="mark">
                                <option value="">-----Select mark</option>
                                <option>Audi</option>
                                <option>BMW</option>
                                <option>Chevrolet</option>
                                <option>Toyota</option>
                                <option>Mercedes</option>
                                <option>Nissan</option>
                                <option>Peugeot</option>
                                <option>Renault</option>

                            </select>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                Model
                            </span>
                            <input type="text" class="form-control"
                                               name="model" id="model" value="" />
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon col">
                                <b>Year *</b>
                            </span>
                            <input type="number" class="form-control"
                                                 name="year" min="0" id="year" value="" />
                            <span class="input-group-addon">year</span>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                Engine
                            </span>
                            <input type="number" step="0.1" min="0" class="form-control"
                                                                    name="engine" id="engine" value="" />
                            <span class="input-group-addon">L</span>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon">
                                Color
                            </span>
                            <select class="form-control" name="color" id="color">
                                <option value="">-----Select color</option>
                                <option>black</option>
                                <option>white</option>
                                <option>metallic</option>
                                <option>red</option>
                                <option>blue</option>
                                <option>green</option>
                                <option>orange</option>
                            </select>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon">
                                Max speed
                            </span>
                            <input type="number" min="0" class="form-control col-lg-3"
                                                         name="maxspeed" id="maxspeed" value="" />
                            <span class="input-group-addon">km/h</span>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                Price
                            </span>
                            <input type="number" min="0" class="form-control col-lg-3"
                                                         name="price" id="price" value="" />
                            <span class="input-group-addon">$</span>
                        </div>
                        <span class="help-block">* Year field is required</span>
                    </div>

                    <div class="col-lg-7 detail" id="detail">
                        <table class="table" id="details">
                        </table>
                    </div>

                </div>
            </form>

            <div class="results" id="results">
                <table class="table" id="table">

                </table>
            </div>

        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="html/js/bootstrap.min.js"></script>

        <script src="html/js/script.js"></script>


    </body>
</html>
