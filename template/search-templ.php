<div class="row">
  <form class="center" action="#" method="GET">
        <div class="row">
            <div class="input-field col s12">
                <i class="material-icons prefix">location_on</i>
                <input id="city" type="text" class="validate" name="city">
                <label for="city">city</label>
            </div>

            <div class="input-field col s12">
                <i class="material-icons prefix">mode_edit</i>
                <input id="name" type="text" class="validate" name="name">
                <label for="name">name</label>
            </div>
            
            <div class="input-field col s12">
                <i class="material-icons prefix">today</i>
                <input id="dateFrom" type="text" class="datepicker" name="dateFrom">
                <label for="dateFrom">from date</label>
            </div>

            <div class="input-field col s12">
                <i class="material-icons prefix">event</i>
                <input id="dateTo" type="text" class="datepicker" name="dateTo">
                <label for="dateTo">to date</label>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">attach_money</i>
                    <input id="priceFrom" type="number" step="0.01" min="0" class="validate" name="priceFrom">
                    <label for="priceFrom">price from</label>
                </div>
                <div class="input-field col s6">
                    <input id="priceTo" type="number" step="0.01" min="0" class="validate" name="priceTo">
                    <label for="priceTo">to</label>
                </div>
            </div>
        </div>
        <a href="javascript:history.go(-1)" class="btn teal darken-3 col s4 addMarginLeft" name="action" value="add">back</a>
        <button id="search"class="btn waves-effect waves-light teal darken-3 col s4 offset-s3 " type="submit" name="action">Search
            <i class="material-icons right">search</i>
        </button>
  </form>
</div>