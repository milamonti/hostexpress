package telas;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class conexao {
    public static String email;
    public static Connection con = null;

    public static Connection Conectar() {
        String servidor = "localhost";
        String user = "root";
        String pass = "";
        String banco = "hostexpress";

        System.out.println("Conectando ao banco...");

        try {
            Class.forName("com.mysql.cj.jdbc.Driver");
            con = DriverManager.getConnection(
                    "jdbc:mysql://" + servidor + "/" + banco,
                    user,
                    pass
            );

            System.out.println("Conectado.");
            return con;
        } catch (ClassNotFoundException ex) {
            System.out.println("Classe não encontrada, adicione o driver nas bibliotecas.");
            return null;
        } catch (SQLException erro) {
            System.out.println("Ocorreu um erro no programa: " + erro);
            return null;
        }
    }

    public static void Desconectar() {
        if (con != null) {
            try {
                con.close();
                con = null;
                System.out.println("Conexão fechada.");
            } catch (SQLException ex) {
                System.out.println("Erro ao fechar a conexão: " + ex);
            }
        }
    }
}