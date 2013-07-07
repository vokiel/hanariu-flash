<?php namespace Hanariu; ?>

<?php if ( !empty($messages) && \Hanariu\Arr::is_array($messages) ): ?>

  <?php foreach ( $messages as $message ): ?>

    <div class="alert alert-<?php echo $message['type']; ?>">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong><?php echo \ucfirst($message['type']);?></strong>: <?php echo $message['message']; ?>
    </div>

  <?php endforeach; ?>

<?php endif; ?>