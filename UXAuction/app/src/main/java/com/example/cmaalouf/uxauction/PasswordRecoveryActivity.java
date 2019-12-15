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

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_fpassword);


    }

    public void send(View v)
    {
        EditText codeEditText = findViewById(R.id.codeField);
        codeEditText.setVisibility(View.VISIBLE);

        TextView codeTextView = findViewById(R.id.sixcodeText);
        codeTextView.setVisibility(View.VISIBLE);

        Button submitButton = findViewById(R.id.submitB);
        submitButton.setVisibility(View.VISIBLE);
    }

    public void submit(View v)
    {
        EditText pwEditText = findViewById(R.id.np1Field);
        EditText confirmEditText = findViewById(R.id.np2Field);

        TextView pwTextView = findViewById(R.id.np1Text);
        TextView confirmTextView = findViewById(R.id.np2Text);

        Button confirmButton = findViewById(R.id.confirm);

        pwEditText.setVisibility(View.VISIBLE);
        confirmEditText.setVisibility(View.VISIBLE);
        pwTextView.setVisibility(View.VISIBLE);
        confirmTextView.setVisibility(View.VISIBLE);
        confirmButton.setVisibility(View.VISIBLE);
    }

    public void confirm(View v)
    {
        Intent intent = new Intent(PasswordRecoveryActivity.this, MainActivity.class );
        PasswordRecoveryActivity.this.startActivity(intent);
    }
}
