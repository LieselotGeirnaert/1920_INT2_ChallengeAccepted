{
  const handleSubmitForm = e => {
    const $form = e.currentTarget;
    if (!$form.checkValidity()) {
      e.preventDefault();

      const fields = $form.querySelectorAll(`.form__input`);
      fields.forEach(showValidationInfo);

    } else {
      console.log(`Form is valid => submit form`);
    }
  };

  const showValidationInfo = $field => {
    console.log($field);
    let message;
    if ($field.validity.valueMissing) {
      message = `Dit veld is verplicht`;
    }
    if ($field.validity.typeMismatch) {
      message = `Er wordt een ${showTypeMismatch($input.getAttribute(`type`))} verwacht`;
    }
    if ($field.validity.rangeOverflow) {
      const max = $field.getAttribute(`max`);
      message = `Te groot, maximum ${max}`;
    }
    if ($field.validity.rangeUnderflow) {
      const min = $field.getAttribute(`min`);
      message = `Te klein, minimum ${min}`;
    }
    if ($field.validity.tooShort) {
      const min = $field.getAttribute(`minlength`);
      message = `Te kort, minimum lengte is ${ min }`;
    }
    if ($field.validity.tooLong) {
      const max = $field.getAttribute(`maxlength`);
      message = `Te lang, maximum lengte is ${ max }`;
    }
    if (message) {
      $field.parentElement.querySelector(`.form__error`).textContent = message;
    }
  };

  const handeInputField = e => {
    const $field = e.currentTarget;
    if ($field.checkValidity()) {
      $field.parentElement.querySelector(`.form__error`).textContent = ``;
      if ($field.form.checkValidity()) {
        $field.form.querySelector(`.form__error`).innerHTML = ``;
      }
    }
  };

  const handeBlurField = e => {
    const $field = e.currentTarget;
    showValidationInfo($field);
  };

  const addValidationListeners = fields => {
    fields.forEach($field => {
      $field.addEventListener(`input`, handeInputField);
      $field.addEventListener(`blur`, handeBlurField);
    });
  };

  const init = () => {
    const $form = document.querySelector(`.new__form`);
    $form.noValidate = true;
    $form.addEventListener(`submit`, handleSubmitForm);

    const fields = $form.querySelectorAll(`.input`);
    addValidationListeners(fields);

  };

  init();
}
