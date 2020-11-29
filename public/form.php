<form class="add_sugestion_form">
  <div class="form-group">
    <label for="input_name"><?php esc_html_e( 'Name: ', 'suggestions' ); ?></label>
    <input type="text" class="form-control" id="input_name" placeholder="John" value="<?php echo $user_data->first_name? $user_data->first_name:''; ?>">
  </div>
  <div class="form-group">
    <label for="input_lastname"><?php esc_html_e( 'Lastname: ', 'suggestions' ); ?></label>
    <input type="text" class="form-control" id="input_lastname" placeholder="Doe" value="<?php echo $user_data->last_name? $user_data->last_name:''; ?>">
  </div>
  <div class="form-group">
    <label for="input_mail"><?php esc_html_e( 'Mail: ', 'suggestions' ); ?></label>
    <input type="email" class="form-control" id="input_mail" placeholder="john@doe.com" value="<?php echo $user_data->user_email? $user_data->user_email:''; ?>">
  </div>

  <div class="form-group">
    <label for="text_suggestion"><?php esc_html_e( 'Your suggestion: ', 'suggestions' ); ?></label>
    <textarea class="form-control" id="text_suggestion" rows="3"></textarea>
  </div>
  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1"><?php esc_html_e( 'I have read the privacy policy', 'suggestions' ); ?></label>
  </div>
  <button type="button" class="btn btn-primary add_sugestion">Submit</button>
</form>
