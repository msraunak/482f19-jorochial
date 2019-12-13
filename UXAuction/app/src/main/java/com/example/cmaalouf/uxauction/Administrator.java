package com.example.cmaalouf.uxauction;

import java.util.List;

public class Administrator
{
    private String username;
    private String password;
    private String firstName;
    private String lastName;
    private String emailAddress;

    //This class doesn't do much yet so I didn't comment it

    public Administrator(String username, String password, String firstName, String lastName, String emailAddress)
    {
        this.username = username;
        this.password = password;
        this.firstName = firstName;
        this.lastName = lastName;
        this.emailAddress = emailAddress;
    }

    public boolean signIn(List<Administrator> listOfSignedInAdministrators, List<Administrator> listOfAllAdmins, Administrator administrator)
    {
        if(this.equals(administrator) && listOfAllAdmins.contains(administrator))
        {
            listOfSignedInAdministrators.add(this);
            return true;
        }

        return false;
    }

    public String changePassword(String newPassword)
    {
        this.password = newPassword;
        return password;
    }

    @Override
    public boolean equals(Object o)
    {
        return this.username.equals(((Administrator) o).username) && this.password.equals(((Administrator) o).password);
    }
}
