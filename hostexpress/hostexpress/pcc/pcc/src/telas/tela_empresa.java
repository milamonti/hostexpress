/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/GUIForms/JFrame.java to edit this template
 */
package telas;

import java.awt.Image;
import java.awt.Toolkit;
import javax.swing.JOptionPane;
import java.net.HttpURLConnection;
import java.net.URL;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.MalformedURLException;
import java.util.regex.Matcher;
import java.util.regex.Pattern;
import org.json.*;

        
public class tela_empresa extends javax.swing.JFrame {

    public tela_empresa() {
        initComponents();
        URL url = this.getClass().getResource("hostexpress.png");
        Image iconeTitulo = Toolkit.getDefaultToolkit().getImage(url);
        this.setIconImage(iconeTitulo);
        tfuf.setEditable(false);
        tfendereco.setEditable(false);
        tfcidade.setEditable(false);
        tfrazao.setEditable(false);
    }
    
    /**
     *
     * @param cnpj
     */
    public void consulta_cnpj(String cnpj){
        String regex = "^(\\d{2})\\.\\d{3}\\.\\d{3}/\\d{4}-\\d{2}$";
        Pattern padrao = Pattern.compile(regex);
        Matcher result = padrao.matcher(cnpj);
        if(result.matches()){
            try{
                cnpj = cnpj.replace("/","").replace("-","").replace(".","");
                String url = "https://brasilapi.com.br/api/cnpj/v1/" + cnpj;
                HttpURLConnection connection = (HttpURLConnection) new URL(url).openConnection();
                connection.setRequestMethod("GET");
                connection.setConnectTimeout(5000); 
                connection.setReadTimeout(5000);
                
                StringBuilder response;
                try (BufferedReader in = new BufferedReader(new InputStreamReader(connection.getInputStream()))) {
                    String inputLine;
                    response = new StringBuilder();
                    while ((inputLine = in.readLine()) != null) {
                        response.append(inputLine);
                    }
                }
            
                JSONObject jsonResponse = new JSONObject(response.toString());
                tfrazao.setText(jsonResponse.getString("razao_social"));
                tfbairro.setText(jsonResponse.getString("bairro"));
                ftfcep.setText(jsonResponse.getString("cep"));
                tfuf.setText(jsonResponse.getString("uf"));
                tfcidade.setText(jsonResponse.getString("municipio"));
                tfendereco.setText(jsonResponse.getString("logradouro"));
                ftftelefone1.setText(jsonResponse.getString("ddd_telefone_1"));
                tfnum.setText(jsonResponse.getString("numero"));
            }
            catch (MalformedURLException ex) {
                JOptionPane.showMessageDialog(null, "CNPJ inválido!");
            }
            catch (IOException | JSONException ex) {
                JOptionPane.showMessageDialog(null, "CNPJ inválido!");
            }
        }
        else{
            JOptionPane.showMessageDialog(null, "Formato inválido!");
        }
    }
    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        jLabel1 = new javax.swing.JLabel();
        jLabel2 = new javax.swing.JLabel();
        jLabel3 = new javax.swing.JLabel();
        jLabel5 = new javax.swing.JLabel();
        jLabel6 = new javax.swing.JLabel();
        jLabel7 = new javax.swing.JLabel();
        jLabel8 = new javax.swing.JLabel();
        jLabel9 = new javax.swing.JLabel();
        jLabel10 = new javax.swing.JLabel();
        jLabel11 = new javax.swing.JLabel();
        tfrazao = new javax.swing.JTextField();
        tfuf = new javax.swing.JTextField();
        tfendereco = new javax.swing.JTextField();
        tfnum = new javax.swing.JTextField();
        tfcompl = new javax.swing.JTextField();
        jLabel12 = new javax.swing.JLabel();
        ComboEsp = new javax.swing.JComboBox<>();
        jButton1 = new javax.swing.JButton();
        jLabel13 = new javax.swing.JLabel();
        jLabel14 = new javax.swing.JLabel();
        tfcidade = new javax.swing.JTextField();
        buscacep = new javax.swing.JButton();
        ftfcpf = new javax.swing.JFormattedTextField();
        ftftelefone1 = new javax.swing.JFormattedTextField();
        ftfcnpj = new javax.swing.JFormattedTextField();
        ftfcep = new javax.swing.JFormattedTextField();
        buscacnpj = new javax.swing.JButton();
        tfbairro = new javax.swing.JTextField();

        setDefaultCloseOperation(javax.swing.WindowConstants.EXIT_ON_CLOSE);
        setTitle("Cadastrar");
        setLocation(new java.awt.Point(700, 250));

        jLabel1.setFont(new java.awt.Font("Verdana", 1, 14)); // NOI18N
        jLabel1.setHorizontalAlignment(javax.swing.SwingConstants.CENTER);
        jLabel1.setText("CADASTRO DE EMPRESA");
        jLabel1.setBorder(javax.swing.BorderFactory.createEtchedBorder());

        jLabel2.setText("CNPJ:");

        jLabel3.setText("Telefone:");

        jLabel5.setText("CEP:");

        jLabel6.setText("Estado:");

        jLabel7.setText("Cidade:");

        jLabel8.setText("Bairro:");

        jLabel9.setText("Endereço:");

        jLabel10.setText("Número:");

        jLabel11.setText("Especialidade:");

        jLabel12.setText("Complemento:");

        ComboEsp.setModel(new javax.swing.DefaultComboBoxModel<>(new String[] { "   ", "Farmaceuticos", "Mercado", "Cosméticos", "Construções", "Roupas", "Eletrodomésticos", "Móveis", "Videogames", "Papelaria", "Automobilístico", "Outro" }));

        jButton1.setBackground(new java.awt.Color(51, 51, 255));
        jButton1.setForeground(new java.awt.Color(255, 255, 255));
        jButton1.setText("Salvar");
        jButton1.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jButton1ActionPerformed(evt);
            }
        });

        jLabel13.setText("CPF:");

        jLabel14.setText("Razão Social");

        buscacep.setIcon(new javax.swing.ImageIcon(getClass().getResource("/src/magnifying-glass (1).png"))); // NOI18N
        buscacep.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                buscacepActionPerformed(evt);
            }
        });

        try {
            ftfcpf.setFormatterFactory(new javax.swing.text.DefaultFormatterFactory(new javax.swing.text.MaskFormatter("###.###.###-##")));
        } catch (java.text.ParseException ex) {
            ex.printStackTrace();
        }

        try {
            ftftelefone1.setFormatterFactory(new javax.swing.text.DefaultFormatterFactory(new javax.swing.text.MaskFormatter("(##)#####-####")));
        } catch (java.text.ParseException ex) {
            ex.printStackTrace();
        }

        try {
            ftfcnpj.setFormatterFactory(new javax.swing.text.DefaultFormatterFactory(new javax.swing.text.MaskFormatter("##.###.###/####-##")));
        } catch (java.text.ParseException ex) {
            ex.printStackTrace();
        }
        ftfcnpj.setText("74.371.717/0001-86");

        try {
            ftfcep.setFormatterFactory(new javax.swing.text.DefaultFormatterFactory(new javax.swing.text.MaskFormatter("##-###-###")));
        } catch (java.text.ParseException ex) {
            ex.printStackTrace();
        }
        ftfcep.setText("13-219-461");
        ftfcep.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                ftfcepActionPerformed(evt);
            }
        });

        buscacnpj.setIcon(new javax.swing.ImageIcon(getClass().getResource("/src/magnifying-glass (1).png"))); // NOI18N
        buscacnpj.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                buscacnpjActionPerformed(evt);
            }
        });

        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(getContentPane());
        getContentPane().setLayout(layout);
        layout.setHorizontalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, layout.createSequentialGroup()
                .addContainerGap(javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                .addComponent(jLabel1, javax.swing.GroupLayout.PREFERRED_SIZE, 360, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addGap(65, 65, 65))
            .addGroup(layout.createSequentialGroup()
                .addGap(28, 28, 28)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING)
                    .addGroup(javax.swing.GroupLayout.Alignment.LEADING, layout.createSequentialGroup()
                        .addComponent(jButton1, javax.swing.GroupLayout.PREFERRED_SIZE, 89, javax.swing.GroupLayout.PREFERRED_SIZE)
                        .addGap(0, 0, Short.MAX_VALUE))
                    .addGroup(layout.createSequentialGroup()
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                            .addComponent(jLabel5)
                            .addComponent(ftftelefone1, javax.swing.GroupLayout.PREFERRED_SIZE, 178, javax.swing.GroupLayout.PREFERRED_SIZE))
                        .addGap(164, 308, Short.MAX_VALUE))
                    .addGroup(layout.createSequentialGroup()
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING)
                            .addGroup(layout.createSequentialGroup()
                                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                    .addComponent(jLabel2)
                                    .addGroup(layout.createSequentialGroup()
                                        .addComponent(ftfcnpj, javax.swing.GroupLayout.PREFERRED_SIZE, 178, javax.swing.GroupLayout.PREFERRED_SIZE)
                                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                                        .addComponent(buscacnpj, javax.swing.GroupLayout.PREFERRED_SIZE, 31, javax.swing.GroupLayout.PREFERRED_SIZE))
                                    .addComponent(jLabel3)
                                    .addComponent(jLabel6)
                                    .addComponent(jLabel9)
                                    .addGroup(layout.createSequentialGroup()
                                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING, false)
                                            .addComponent(tfuf, javax.swing.GroupLayout.Alignment.LEADING)
                                            .addComponent(ftfcep, javax.swing.GroupLayout.PREFERRED_SIZE, 178, javax.swing.GroupLayout.PREFERRED_SIZE))
                                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                                        .addComponent(buscacep, javax.swing.GroupLayout.PREFERRED_SIZE, 31, javax.swing.GroupLayout.PREFERRED_SIZE)))
                                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                    .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING, false)
                                        .addComponent(jLabel7)
                                        .addComponent(jLabel11)
                                        .addComponent(jLabel14)
                                        .addComponent(tfcidade, javax.swing.GroupLayout.DEFAULT_SIZE, 188, Short.MAX_VALUE)
                                        .addComponent(jLabel13)
                                        .addComponent(tfrazao)
                                        .addComponent(ftfcpf)
                                        .addComponent(ComboEsp, 0, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE))
                                    .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                        .addComponent(tfnum, javax.swing.GroupLayout.PREFERRED_SIZE, 58, javax.swing.GroupLayout.PREFERRED_SIZE)
                                        .addComponent(jLabel10, javax.swing.GroupLayout.PREFERRED_SIZE, 60, javax.swing.GroupLayout.PREFERRED_SIZE))))
                            .addGroup(javax.swing.GroupLayout.Alignment.LEADING, layout.createSequentialGroup()
                                .addComponent(tfendereco, javax.swing.GroupLayout.PREFERRED_SIZE, 381, javax.swing.GroupLayout.PREFERRED_SIZE)
                                .addGap(0, 0, Short.MAX_VALUE))
                            .addGroup(javax.swing.GroupLayout.Alignment.LEADING, layout.createSequentialGroup()
                                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                    .addComponent(jLabel12)
                                    .addComponent(tfcompl, javax.swing.GroupLayout.PREFERRED_SIZE, 199, javax.swing.GroupLayout.PREFERRED_SIZE))
                                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                    .addGroup(layout.createSequentialGroup()
                                        .addGap(14, 14, 14)
                                        .addComponent(jLabel8))
                                    .addGroup(layout.createSequentialGroup()
                                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.UNRELATED)
                                        .addComponent(tfbairro)))))
                        .addGap(21, 21, 21))))
        );
        layout.setVerticalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(layout.createSequentialGroup()
                .addComponent(jLabel1)
                .addGap(13, 13, 13)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(jLabel2)
                    .addComponent(jLabel11))
                .addGap(6, 6, 6)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                        .addComponent(ComboEsp, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                        .addComponent(ftfcnpj, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))
                    .addComponent(buscacnpj, javax.swing.GroupLayout.PREFERRED_SIZE, 22, javax.swing.GroupLayout.PREFERRED_SIZE))
                .addGap(6, 6, 6)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(jLabel3)
                    .addComponent(jLabel14))
                .addGap(6, 6, 6)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(ftftelefone1, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(tfrazao, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))
                .addGap(6, 6, 6)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(jLabel13)
                    .addComponent(jLabel5))
                .addGap(11, 11, 11)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING)
                    .addComponent(ftfcpf, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(ftfcep, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(buscacep, javax.swing.GroupLayout.Alignment.LEADING, javax.swing.GroupLayout.PREFERRED_SIZE, 22, javax.swing.GroupLayout.PREFERRED_SIZE))
                .addGap(7, 7, 7)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addComponent(jLabel7)
                    .addComponent(jLabel6))
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addComponent(tfcidade, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(tfuf, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(jLabel9)
                    .addComponent(jLabel10))
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(tfendereco, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(tfnum, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))
                .addGap(18, 18, 18)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(jLabel12)
                    .addComponent(jLabel8))
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(tfcompl, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(tfbairro, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))
                .addGap(18, 18, 18)
                .addComponent(jButton1, javax.swing.GroupLayout.PREFERRED_SIZE, 32, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addContainerGap(22, Short.MAX_VALUE))
        );

        pack();
    }// </editor-fold>//GEN-END:initComponents

    private void jButton1ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_jButton1ActionPerformed
        //ENVIAR CADASTRO DA EMPRESA PARA CADASTRO_EMPRESAS COM CONFIRMADO 'N'
        JOptionPane.showMessageDialog(null,"Agradecemos seu cadastro!\nEle será analisado e você receberá um E-mail com o resultado!");
    }//GEN-LAST:event_jButton1ActionPerformed

    private void buscacepActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_buscacepActionPerformed
        // TODO add your handling code here:
        String cep = ftfcep.getText().replace("-", "");
        String url = "https://viacep.com.br/ws/" + cep + "/json/";
        
        try {
            URL obj = new URL(url);
            HttpURLConnection con = (HttpURLConnection) obj.openConnection();
            con.setRequestMethod("GET");

            StringBuilder response;
            try (BufferedReader in = new BufferedReader(new InputStreamReader(con.getInputStream()))) {
                String inputLine;
                response = new StringBuilder();
                while ((inputLine = in.readLine()) != null) {
                    response.append(inputLine);
                }
            }

            JSONObject myResponse = new JSONObject(response.toString());

            tfendereco.setText(myResponse.getString("logradouro"));
            tfbairro.setText(myResponse.getString("bairro"));
            tfcidade.setText(myResponse.getString("localidade"));
            tfuf.setText(myResponse.getString("uf"));

        } 
        catch (IOException | JSONException e) {
            System.out.println(e);
        }
    }//GEN-LAST:event_buscacepActionPerformed

    private void buscacnpjActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_buscacnpjActionPerformed
        consulta_cnpj(ftfcnpj.getText());
    }//GEN-LAST:event_buscacnpjActionPerformed

    private void ftfcepActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_ftfcepActionPerformed
        // TODO add your handling code here:
    }//GEN-LAST:event_ftfcepActionPerformed

    /**
     * @param args the command line arguments
     */
    public static void main(String args[]) {
        /* Set the Nimbus look and feel */
        //<editor-fold defaultstate="collapsed" desc=" Look and feel setting code (optional) ">
        /* If Nimbus (introduced in Java SE 6) is not available, stay with the default look and feel.
         * For details see http://download.oracle.com/javase/tutorial/uiswing/lookandfeel/plaf.html 
         */
        try {
            for (javax.swing.UIManager.LookAndFeelInfo info : javax.swing.UIManager.getInstalledLookAndFeels()) {
                if ("Nimbus".equals(info.getName())) {
                    javax.swing.UIManager.setLookAndFeel(info.getClassName());
                    break;
                }
            }
        } catch (ClassNotFoundException | InstantiationException | IllegalAccessException | javax.swing.UnsupportedLookAndFeelException ex) {
            java.util.logging.Logger.getLogger(tela_empresa.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        }
        //</editor-fold>
        
        //</editor-fold>

        /* Create and display the form */
        java.awt.EventQueue.invokeLater(() -> {
            new tela_empresa().setVisible(true);
        });
    }

    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JComboBox<String> ComboEsp;
    private javax.swing.JButton buscacep;
    private javax.swing.JButton buscacnpj;
    private javax.swing.JFormattedTextField ftfcep;
    private javax.swing.JFormattedTextField ftfcnpj;
    private javax.swing.JFormattedTextField ftfcpf;
    private javax.swing.JFormattedTextField ftftelefone1;
    private javax.swing.JButton jButton1;
    private javax.swing.JLabel jLabel1;
    private javax.swing.JLabel jLabel10;
    private javax.swing.JLabel jLabel11;
    private javax.swing.JLabel jLabel12;
    private javax.swing.JLabel jLabel13;
    private javax.swing.JLabel jLabel14;
    private javax.swing.JLabel jLabel2;
    private javax.swing.JLabel jLabel3;
    private javax.swing.JLabel jLabel5;
    private javax.swing.JLabel jLabel6;
    private javax.swing.JLabel jLabel7;
    private javax.swing.JLabel jLabel8;
    private javax.swing.JLabel jLabel9;
    private javax.swing.JTextField tfbairro;
    private javax.swing.JTextField tfcidade;
    private javax.swing.JTextField tfcompl;
    private javax.swing.JTextField tfendereco;
    private javax.swing.JTextField tfnum;
    private javax.swing.JTextField tfrazao;
    private javax.swing.JTextField tfuf;
    // End of variables declaration//GEN-END:variables
}
