<div class="container-fluid">
    <div class="mt-1">
        <h1><a href="/">To</a><span class="font-weight-lighter">{do}</span><a href="/done">ne</a></h1>


        <?php foreach ($todos as $todo) { ?>
            <div class="input-group todo mb-3 todo-status-<?php echo $todo['status'] ?>">
                <div class="dropdown-menu dropdown-menu-sm" id="context-menu">
                    <?php $toggleStickyStatus = $todo['is_sticky'] ? 0 : 1 ?>
                    <a class="dropdown-item delete-<?php echo $todo['status']; ?>" href="<?php echo $base_url . '/todo/togglesticky/' . $todo['todo_id'] . '/' . $toggleStickyStatus; ?>">Sätt sticky
                        <svg class="bi bi-arrow-down-left float-right" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M5 9.5a.5.5 0 01.5.5v4.5H10a.5.5 0 010 1H5a.5.5 0 01-.5-.5v-5a.5.5 0 01.5-.5z" clip-rule="evenodd"></path>
                            <path fill-rule="evenodd" d="M14.354 5.646a.5.5 0 010 .708l-9 9a.5.5 0 01-.708-.708l9-9a.5.5 0 01.708 0z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                    <a class="dropdown-item" href="#">Redigera
                        <span class="float-right edit-<?php echo $todo['status']; ?>" data-id="<?php echo $todo['todo_id']; ?>">
                            <svg class="bi bi-pencil" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M13.293 3.293a1 1 0 011.414 0l2 2a1 1 0 010 1.414l-9 9a1 1 0 01-.39.242l-3 1a1 1 0 01-1.266-1.265l1-3a1 1 0 01.242-.391l9-9zM14 4l2 2-9 9-3 1 1-3 9-9z" clip-rule="evenodd"></path>
                                <path fill-rule="evenodd" d="M14.146 8.354l-2.5-2.5.708-.708 2.5 2.5-.708.708zM5 12v.5a.5.5 0 00.5.5H6v.5a.5.5 0 00.5.5H7v.5a.5.5 0 00.5.5H8v-1.5a.5.5 0 00-.5-.5H7v-.5a.5.5 0 00-.5-.5H5z" clip-rule="evenodd"></path>
                            </svg>
                        </span>
                    </a>
                    <a class="warning dropdown-item delete-<?php echo $todo['status']; ?>" href="<?php echo $base_url . '/todo/delete/' . $todo['todo_id']; ?>">Radera 
                        <svg class="bi bi-trash float-right" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.5 7.5A.5.5 0 018 8v6a.5.5 0 01-1 0V8a.5.5 0 01.5-.5zm2.5 0a.5.5 0 01.5.5v6a.5.5 0 01-1 0V8a.5.5 0 01.5-.5zm3 .5a.5.5 0 00-1 0v6a.5.5 0 001 0V8z"></path>
                            <path fill-rule="evenodd" d="M16.5 5a1 1 0 01-1 1H15v9a2 2 0 01-2 2H7a2 2 0 01-2-2V6h-.5a1 1 0 01-1-1V4a1 1 0 011-1H8a1 1 0 011-1h2a1 1 0 011 1h3.5a1 1 0 011 1v1zM6.118 6L6 6.059V15a1 1 0 001 1h6a1 1 0 001-1V6.059L13.882 6H6.118zM4.5 5V4h11v1h-11z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <input data-id="<?php echo $todo['todo_id']; ?>" type="checkbox" <?php echo $todo['status'] == 1 ? 'checked' : ''; ?> aria-label="Checkbox for following text input">
                    </div>
                </div>
                <?php $todo['text'] = preg_replace('/(?<!\S)#([0-9a-zA-Z]+)/', '<a href="/todo/hashtag/$1">#$1</a>', $todo['text']); ?>
                <span>
                    <?php
                    if ($todo['is_sticky']) { ?>
                        <svg class="bi bi-arrow-down-left" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M5 9.5a.5.5 0 01.5.5v4.5H10a.5.5 0 010 1H5a.5.5 0 01-.5-.5v-5a.5.5 0 01.5-.5z" clip-rule="evenodd"></path>
                            <path fill-rule="evenodd" d="M14.354 5.646a.5.5 0 010 .708l-9 9a.5.5 0 01-.708-.708l9-9a.5.5 0 01.708 0z" clip-rule="evenodd"></path>
                        </svg>
                    <?php }
                    echo $todo['text'];
                    ?>
                    <a class="float-right delete-<?php echo $todo['status']; ?>" href="<?php echo $base_url . '/todo/delete/' . $todo['todo_id']; ?>">
                        <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.5 7.5A.5.5 0 018 8v6a.5.5 0 01-1 0V8a.5.5 0 01.5-.5zm2.5 0a.5.5 0 01.5.5v6a.5.5 0 01-1 0V8a.5.5 0 01.5-.5zm3 .5a.5.5 0 00-1 0v6a.5.5 0 001 0V8z"></path>
                            <path fill-rule="evenodd" d="M16.5 5a1 1 0 01-1 1H15v9a2 2 0 01-2 2H7a2 2 0 01-2-2V6h-.5a1 1 0 01-1-1V4a1 1 0 011-1H8a1 1 0 011-1h2a1 1 0 011 1h3.5a1 1 0 011 1v1zM6.118 6L6 6.059V15a1 1 0 001 1h6a1 1 0 001-1V6.059L13.882 6H6.118zM4.5 5V4h11v1h-11z" clip-rule="evenodd"></path>
                        </svg>
                    </a>

                    <span class="float-right edit-<?php echo $todo['status']; ?>" data-id="<?php echo $todo['todo_id']; ?>">
                        <svg class="bi bi-pencil" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M13.293 3.293a1 1 0 011.414 0l2 2a1 1 0 010 1.414l-9 9a1 1 0 01-.39.242l-3 1a1 1 0 01-1.266-1.265l1-3a1 1 0 01.242-.391l9-9zM14 4l2 2-9 9-3 1 1-3 9-9z" clip-rule="evenodd"></path>
                            <path fill-rule="evenodd" d="M14.146 8.354l-2.5-2.5.708-.708 2.5 2.5-.708.708zM5 12v.5a.5.5 0 00.5.5H6v.5a.5.5 0 00.5.5H7v.5a.5.5 0 00.5.5H8v-1.5a.5.5 0 00-.5-.5H7v-.5a.5.5 0 00-.5-.5H5z" clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <?php if ($todo['is_sticky']) {  ?>
                        <a class="float-right delete-<?php echo $todo['status']; ?>" href="<?php echo $base_url . '/todo/togglesticky/' . $todo['todo_id']; ?>/0">
                            <svg class="bi bi-arrow-down-left" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M5 9.5a.5.5 0 01.5.5v4.5H10a.5.5 0 010 1H5a.5.5 0 01-.5-.5v-5a.5.5 0 01.5-.5z" clip-rule="evenodd"></path>
                                <path fill-rule="evenodd" d="M14.354 5.646a.5.5 0 010 .708l-9 9a.5.5 0 01-.708-.708l9-9a.5.5 0 01.708 0z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    <?php } else {  ?>
                        <a class="float-right delete-<?php echo $todo['status']; ?>" href="<?php echo $base_url . '/todo/togglesticky/' . $todo['todo_id']; ?>/1">
                            <svg class="bi bi-arrow-up-right" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8.5 6a.5.5 0 01.5-.5h5a.5.5 0 01.5.5v5a.5.5 0 01-1 0V6.5H9a.5.5 0 01-.5-.5z" clip-rule="evenodd"></path>
                                <path fill-rule="evenodd" d="M14.354 5.646a.5.5 0 010 .708l-9 9a.5.5 0 01-.708-.708l9-9a.5.5 0 01.708 0z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    <?php }  ?>
                </span>
            </div>
        <?php } ?>

    </div>
</div>
<nav class="navbar fixed-bottom navbar-expand navbar-dark bg-dark">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample02">
        <ul class="navbar-nav">
            <li class="nav-item dropup">
                <a class="nav-link navbar-brand active dropdown-toggle" href="#" id="dropdown10" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Weekloggr </a>
                <div class="dropdown-menu" aria-labelledby="dropdown10">
                    <a class="dropdown-item toggle-all d-none" href="#"><small>Visa alla gömda</small></a>
                    <a class="dropdown-item" href="<?php echo $base_url; ?>/settings">Settings</a>
                </div>
            </li>
        </ul>
        <form method="POST" name="addTodo" action="<?php echo $base_url; ?>/addtodo">
            <input class="form-control text" name="todo" type="text" placeholder="What to do?">
            <button type="submit" class="d-none">Skicka</button>
        </form>
    </div>
</nav>