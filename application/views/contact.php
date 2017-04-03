<div class="container-contact">  
  <form id="contact" action="" method="post">
    <h3>CLUS Survey</h3>
    <h4>Please fill up the form to continue</h4>
    <fieldset>
      <input placeholder="First Name" name="first_name" type="text" tabindex="1" autofocus>
    </fieldset>
    <fieldset>
      <input placeholder="Last Name" name="last_name" type="text" tabindex="2" autofocus>
    </fieldset>
    <fieldset>
      <input placeholder="Email Address" name="email_address" type="email" tabindex="3" >
    </fieldset>
    <fieldset>
      <input placeholder="Phone Number (optional)" name="phone_number" type="tel" tabindex="4">
    </fieldset>
    <fieldset>
      <select tabindex="5" required name="county">
        <option value="">Please select county...</option>
        <?php if (!EMPTY($counties)): 
          foreach($counties as $c) :
        ?>
          <option value="<?php echo $c->county_name . '|' . $c->id; ; ?>"><?php echo $c->county_name; ?></option>
        <?php
          endforeach;  
        endif;
        ?>
      </select>
    </fieldset>
    <fieldset>
      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Continue</button>
    </fieldset>
  </form>
</div>