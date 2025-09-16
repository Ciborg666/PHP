<?php
    $succes = false;
    $contact_submit = $_POST['contact_form'] ?? '';

    if($contact_submit == 'submited'){

        $name = strip_tags(trim($_POST['name']));
        $phone = strip_tags(trim($_POST['phone']));
        $text = strip_tags(trim($_POST['text']));
        $yes = strip_tags(trim($_POST['yes']));
        $body = $name ."\n".$phone."\n".$text."\n".$yes;

        if($name == '' || $phone == '' || $text == ''){
            $errors = "Заполните необходимые поля";    
        } else if(mb_strlen($name, 'utf-8') > 20){
            $errors = "Имя не может быть длинне 20 символов";
        } else {
            mail('alexandr@gmail.com','Contact Message',$body);
            $succes = true;

        } 
    }

?>

<h1>Contact Form</h1>
<style>
    label {
        width: 150px;
        display: block;
    }
</style>

<?php if($succes) {
    echo "Форма успешно отправлена";
} else {
    if(isset($errors)) echo $errors;
    ?>
    <form method="post" action="">
        <p><label for="name">Name:</label><input type="text" id="name" value="<?php if(isset($name)) echo $name; ?>" name="name"></p>
        <p><label for="phone">Phone:</label><input type="text" id="phone" name="phone" value="<?php if(isset($phone)) echo $phone; ?>"></p>
        <p><label for="text">Text:</label><textarea name="text" id="text" value="<?php if(isset($text)) echo $text; ?>"></textarea></p>
        <p><label for="yes">Yes or No</label><input type="checkbox" id="yes" name="yes" value="<?php if(isset($yes) && $yes == 'on') echo "checked"; ?>"></p>
        <button name="contact_form" value="submited">Send Contact</button>
    </form>
<?php } ?>