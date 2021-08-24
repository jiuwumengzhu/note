import java.io.*;


import java.io.ObjectOutputStream;
import java.io.ObjectInputStream;
import java.io.FileOutputStream;
import java.io.FileInputStream;


public class Test{

    public static void main(String args[]) throws Exception {
        String obj = "helloworld";


        FileOutputStream fos = new FileOutputStream("lcx.txt");
        ObjectOutputStream os = new ObjectOutputStream(fos);
        os.writeObject(obj);
        os.close();
        System.out.println(os);

        FileInputStream fis = new FileInputStream("lcx.txt");
        System.out.println(fis);
        ObjectInputStream ois = new ObjectInputStream(fis);

        String obj2 = (String)ois.readObject();
        System.out.println(obj2);
        ois.close();
    }

}