<form method="post" class="form-design" id="update-review">
    <div class="centered_text form-header">ОТЗЫВ</div>
    <div class="form-container">
        <p>
            <input type="text" name="username" id="username" value="<?=$data['username']?>">
        </p>
        <p>
            Оценка: <?=$data['rating']?>/10
        </p>
        <div class="rating" id="rating" user-rating="<?=$data['rating']?>"></div>
        <p>
            <label for="email">Почта для связи</label>
            <input type="email" name="email" id="email" value="<?=$data['email']?>">
        </p>
        <p>
            <label for="reviewed_product">Тип продукта для обзора</label>
            <select name="reviewed_product" id="reviewed_product">
                <?php foreach ($data['select_fields'] as $key => $type) {?>
                    <option value="<?=$key?>" <?=$key!=$data['reviewed_product'] ?: 'selected'?>><?=$type?></option>
                <?php }?>
            </select>
        </p>
        <p>
            <label for="satisfaction">Довольны товаром?</label>
            <input type="checkbox" name="satisfaction" id="satisfaction" <?=$data['satisfaction'] ? 'checked' : ''?>
                    class="form_checkbox">
        </p>
        <p>
            <input type="text" name="comment" placeholder="Комментарий" id="comment" value="<?=$data['comment']?>">
        </p>
        <input type="hidden" name="review_id" id="review_id" value="<?=$data['review_id']?>">
        <button type="submit" name="Update review" class="btn-login"><?=$data['review_id'] ? 'Изменить отзыв' : 'Добавить отзыв'?></button>
        <div id="review_message"></div>
    </div>
</form>