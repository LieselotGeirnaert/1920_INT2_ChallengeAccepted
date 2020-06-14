{
  let situationIndex = 1;

  const changeSituation = index => {
    showSituation(situationIndex += index);
    console.log(situationIndex);
  } 

  const currentSituation = index => {
    showSituation(situationIndex = index);
  }

  const showSituation = index => {
    const $situations = document.querySelectorAll('.situation');
    const $sliderDots = document.querySelectorAll('.slider__dot');


    if (index > $situations.length) { situationIndex = 1 }
    if (index < 1) { situationIndex = $situations.length }

    for (let i = 0; i < $situations.length; i++) {
      $situations[i].style.display = 'none';
    }
    for (let i = 0; i < $sliderDots.length; i++) {
      $sliderDots[i].classList.remove('slider__dot--active');
    }

    $situations[situationIndex - 1].style.display = 'flex';
    $sliderDots[situationIndex - 1].classList.add('slider__dot--active');

  }


  const init = () => {
    document.documentElement.classList.add('has-js');

    const $sliderNext = document.querySelector('.slider__control--next');
    const $sliderPrev = document.querySelector('.slider__control--prev');

    const $sliderDots = document.querySelectorAll('.slider__dot');
    if ($sliderDots.length > 0) {
      for (let i = 0; i < $sliderDots.length; i++) {
        $sliderDots[i].addEventListener('click', () => { currentSituation(i + 1) });
      }
     
      $sliderNext.addEventListener('click', () => { changeSituation(1) });
      $sliderPrev.addEventListener('click', () => { changeSituation(-1) });
     
      showSituation(situationIndex);
    }
    
   
    
    
  };

  init();
}
