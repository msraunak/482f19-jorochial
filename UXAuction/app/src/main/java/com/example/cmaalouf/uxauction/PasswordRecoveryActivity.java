package com.example.cmaalouf.uxauction;

import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

public class PasswordRecoveryActivity extends AppCompatActivity {
    String code;
    EditText codeEditText;
    TextView codeTextView;
    Button submitButton;
    EditText pwEditText ;
EditText confirmEditText ;
TextView pwTextView;
TextView confirmTextView ;
Button confirmButton ;
    /**
    * Purpose: initialize activity data and view from xml layout
    * @param savedInstanceState saved state information this method can use when called
    */
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_fpassword);

        Random rand = new Random();
        int num_code = new Random(999999);
        code = String.format("%06d", num_code);


    }

    /**
     * Purpose: Update the screen when the send button is pressed
     * @param v convention for onClick methods
     */
    public void send(View v)
    {

        EditText emailField = findViewById(R.id.usernameField);
        String email = emailField.getText();
        String emailSubject = "Forgot Password from Jorochial";
        String emailMessage = "This message is from AuctionForHaiti. \n\n Your secret code is "+ code +". \n Sincerely, \n Jorochial";


        try {

            URL url = new URL("http://jorochial.cs.loyola.edu/php/sendEmail.php?emailAddress="+email+"&emailSubject="+emailSubject+"&emailMessage="+emailMessage);
            HttpURLConnection con = (HttpURLConnection) url.openConnection();
            //Log.w("HHTP STAT", valueOf(con.getResponseCode()));
            con.setRequestMethod("GET");

            con.setDoOutput( true );
            con.setDoInput(true);

            con.disconnect();



          codeEditText = findViewById(R.id.codeField);
          codeTextView = findViewById(R.id.sixcodeText);
          submitButton = findViewById(R.id.submitB);
          codeEditText.setVisibility(View.VISIBLE);
          codeTextView.setVisibility(View.VISIBLE);
          submitButton.setVisibility(View.VISIBLE);

        } catch (MalformedURLException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
      }
    /**
     * Purpose: Update the screen when the submit button is pressed
     * @param v convention for onClick methods
     */
    public void submit(View v)
    {
      pwEditText = findViewById(R.id.np1Field);
      confirmEditText = findViewById(R.id.np2Field);

      pwTextView = findViewById(R.id.np1Text);
      confirmTextView = findViewById(R.id.np2Text);

      confirmButton = findViewById(R.id.confirm);

      if code.equals(codeEditText.getText()){
        pwEditText.setVisibility(View.VISIBLE);
        confirmEditText.setVisibility(View.VISIBLE);
        pwTextView.setVisibility(View.VISIBLE);
        confirmTextView.setVisibility(View.VISIBLE);
        confirmButton.setVisibility(View.VISIBLE);
        }

    }

    /**
     * Purpose: Update the screen when the confirm button is pressed
     * @param v convention for onClick methods
     */
    public void confirm(View v)
    {

        





        Intent intent = new Intent(PasswordRecoveryActivity.this, MainActivity.class );
        PasswordRecoveryActivity.this.startActivity(intent);
    }
}
