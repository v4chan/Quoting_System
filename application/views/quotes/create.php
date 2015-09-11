<html lang="en">

  <head>

    <style type="text/css">

      body {
        text-align: center;
      }

      #input_form {
        background-color: teal;
        width: 450px;
        max-height: 350px;
      }

      #input_value {
        text-align: left;
      }

      label {
        margin-left: 5%;
        float: left;
      }

      .info_input{
        margin-right: 5%;
        float: right;
      }

    </style>

  </head>

  <body>

      <div id="input_form">
        <h2><?php echo $title; ?></h2>

        <?php echo validation_errors(); ?>

        <?php echo form_open('quotes/create'); ?>
          <div id="input_value">
            <label for="Apparel Type">Apparel Type</label>
            <select class="info_input" name="apparel_type">
              <option value="Gildan G500">Gildan G500</option>
              <option value="American Apparel 2001">American Apparel 2001</option>
              <option value="Canvas 3001C">Canvas 3001C</option>
              <option value="Tultex 0202TC">Tultex 0202TC</option>
            </select>
            <br />
            <br />

            <label for="Apparel Color">Apparel Color</label>
            <select class="info_input" name="apparel_color">
              <option value="White">White</option>
              <option value="Color">Color</option>
            </select>
            <br />
            <br />

            <label for="Quantity Ordered">Quantity Ordered</label>
            <input class="info_input" type="input" name="quantity_ordered" value=0></input>
            <br />
            <br />

            <label for="Number of Front Colors">Number of Front Colors Printed</label>
            <input class="info_input" type="input" name="front_colors" value=0></input>
            <br />
            <br />

            <label for="Number of Back Colors">Number of Back Colors Printed</label>
            <input class="info_input" type="input" name="back_colors" value=0></input>
            <br />
            <br />
          </div>
        <input type="submit" name="submit" value="Submit" />
        <br />
        <br />
      </div>

    </form>

  </body>

</html>