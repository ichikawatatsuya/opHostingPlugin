<form action="" method="POST">
  <table>
    <?php echo $form['name']->renderRow() ?>

    <?php include_partial('themeSelectRows', array('form' => $form)); ?>

    <tr>
      <td colspan="2">
        <?php echo $form->renderHiddenFields(); ?>
        <input type="submit" />
      </td>
    </tr>
  </table>
</form>