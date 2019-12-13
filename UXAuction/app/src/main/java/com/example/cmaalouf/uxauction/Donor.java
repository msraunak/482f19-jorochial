package com.example.cmaalouf.uxauction;

import java.util.HashSet;
import java.util.Set;

public class Donor
{
    private String name;
    private String representativeName;
    private String phoneNumber;
    private String address;
    private String emailAddress;
    private Set<Item> itemsDonated;

    public Donor(String name, String representativeName, String phoneNumber, String address, String emailAddress)
    {
        this.name = name;
        this.representativeName = representativeName;
        this.phoneNumber = phoneNumber;
        this.address = address;
        this.emailAddress = emailAddress;
        itemsDonated = new HashSet<>();
    }

    /**
     * Purpose: give other classes access to the set of items this donor donated
     * @return the set of items this donor donated
     */
    public Set<Item> getItemsDonated()
    {
        return this.itemsDonated;
    }

    /**
     * Purpose: tell java how to print a donor
     * @return the string to print
     */
    public String toString()
    {
        String str = "";
        str += this.name;
        return str;
    }
}
