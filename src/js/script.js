{
  let situationIndex = 1;

  const handleSubmitForm = e => {
    e.preventDefault();
    submitWithJS();
  };

  const handleChangeFilter = e => {
    submitWithJS();
  }

  const submitWithJS = async () => {
    const $form = document.querySelector('.filterform');
    const data = new FormData($form);
    const entries = [...data.entries()];
    const qs = new URLSearchParams(entries).toString();
    const url = `${$form.getAttribute('action')}?${qs}`;
    const response = await fetch(url, {
      headers: new Headers({
        Accept: 'application/json'
      })
    });

    const experiences = await response.json();
    updateList(experiences);
  }

  const updateList = experiences => {
    const $experiences = document.querySelector('.experiences-container');

    if (experiences.length === 0) {
      $experiences.innerHTML = `
        <a href="index.php?page=hindersituaties" class="experience experience--new" >
          <p class="experience__title">Deel een eerste ervaring</p>
          <span class="experience__video"></span>
          <span class="experience__stats"></span>
          <span class="experience__link"></span>
        </a>`;
    } else {
      $experiences.innerHTML = `
        <a href="index.php?page=hindersituaties" class="experience experience--new" >
          <p class="experience__title">Deel een nieuwe ervaring</p>
          <span class="experience__video"></span>
          <span class="experience__stats"></span>
          <span class="experience__link"></span>
        </a>`;
    }
    
    $experiences.innerHTML += experiences.map(experience => {
      return `
        <article class="experience">
          <h3 class="experience__title">${experience.situation_name}</h3>
          <video controls class="experience__video">
            <source src="${experience.video}" type="video/mp4">
            Your browser does not support the video tag.
          </video>
          <form method="post" action="index.php?page=hinderoverzicht" class="experience__like">
            <input type="hidden" name="likes" value="${experience.likes}">
            <input type="hidden" name="experience_id" value="${experience.id}">
            <input type="hidden" name="action" value="addLike">
            <input class="btn btn--like" type="submit" value=""/>
          </form>
          <div class="experience__stats">
            <p class="stats__icon stats__icon--likes">${experience.likes}</p>
            <p class="stats__icon stats__icon--reviews">${Number(experience.review_count)}</p>
            <p class="stats__icon stats__icon--rating">${Number(experience.rating_average)}</p>
          </div>
          <div class="experience__details">
            <p class="experience__user">${experience.user_name}</p>
            <p class="experience__time" > ${experience.date}</p>
          </div>
          <a href="index.php?page=hinderervaring&id=${experience.id}" class="experience__link"><span class="hidden">Details</span></a>
        </article>
      `;
    }).join(``);
  }

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

    document.querySelectorAll('.filter__select').forEach($select => $select.addEventListener('change', handleChangeFilter));
    // document.querySelector('.filterform').addEventListener('submit', handleSubmitForm);

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
