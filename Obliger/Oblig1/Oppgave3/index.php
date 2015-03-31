<html>

  <head>

  </head>

  <body>
    <form action="recieveInfo.php" method="post">
        <input type="text" name="navn" placeholder="Navn" required>
        <input type="email" name="epost" placeholder="Mailadresse" required>
        <input type="text" name="tlfnr" placeholder="Telefonnummer" required>
        <select name="billettype" required>
            <option value="VIP">VIP</option>
            <option value="Business">Business</option>
            <option value="Sofa">Sofa</option>
            <option value="Ståplass">Ståplass</option>
        </select>
        <p>Antall billetter</p>
        <input type="number" name="antallBilletter" value="1" required style="width: 50px">
        <input type="submit">

    </form>
  </body>

</html>