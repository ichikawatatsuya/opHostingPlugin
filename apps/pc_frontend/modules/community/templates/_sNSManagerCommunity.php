<form action="" method="POST">
  <table>
    <?php echo $form ?>
    <tr>
      <td colspan="2">
        <?php echo $form->renderHiddenFields(); ?>
        <input type="submit" />
      </td>
    </tr>
  </table>
</form>