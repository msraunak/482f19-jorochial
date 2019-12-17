package com.example.cmaalouf.uxauction;

import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

import java.io.IOException;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.Random;

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


        int num_code = new Random(999999).nextInt();
        code = String.format("%06d", num_code);


    }

    /**
     * Purpose: Update the screen when the send button is pressed
     * @param v convention for onClick methods
     */
    public void send(View v) {

        EditText emailField = findViewById(R.id.usernameField);
        String email = emailField.getText().toString();
        String emailSubject = "Forgot Password from Jorochial";
        String emailMessage = "This message is from AuctionForHaiti.  Your secret code is " + code + ".  Sincerely,  Jorochial";
        EmailFetch eprocess = new EmailFetch(this);
        eprocess.execute(email,emailMessage);
        codeEditText = findViewById(R.id.codeField);
        codeTextView = findViewById(R.id.sixcodeText);
        submitButton = findViewById(R.id.submitB);
        codeEditText.setVisibility(View.VISIBLE);
        codeTextView.setVisibility(View.VISIBLE);
        submitButton.setVisibility(View.VISIBLE);
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

      if(code.equals(codeEditText.getText())){
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


      /*  if pwEditText.getText().equals(confirmEditText.getText()){
          try {
              //items.add("before url");

              String passw = pwEditText.getText()
              //String passw = "pwd";//strings[1];
              URL url = new URL("http://jorochial.cs.loyola.edu/php/resetPwd.php");



              Map<String,Object> params = new LinkedHashMap<>();
              params.put("username", user );
              params.put("pwd", ""+passw);
              params.put("email",""+email);

              StringBuilder postData = new StringBuilder();
              for (Map.Entry<String,Object> param : params.entrySet()) {
                  if (postData.length() != 0) postData.append('&');
                  postData.append(URLEncoder.encode(param.getKey(), "UTF-8"));
                  postData.append('=');
                  postData.append(URLEncoder.encode(String.valueOf(param.getValue()), "UTF-8"));
              }
              byte[] postDataBytes = postData.toString().getBytes("UTF-8");



              HttpURLConnection con = (HttpURLConnection) url.openConnection();
              //Log.w("HHTP STAT", valueOf(con.getResponseCode()));
              con.setRequestMethod("POST");
              //con.setRequestProperty("username","hfranceschi");
              //con.setRequestProperty("password","pwd");
              con.setRequestProperty("Content-Type", "application/x-www-form-urlencoded");
              con.setRequestProperty("Content-Length", String.valueOf(postDataBytes.length));
              con.setDoOutput( true );
              con.setDoInput(true);

        }

*/


        Intent intent = new Intent(PasswordRecoveryActivity.this, MainActivity.class );
        PasswordRecoveryActivity.this.startActivity(intent);
    }
}
