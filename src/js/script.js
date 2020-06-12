{
  const showFact = async () => {
    const year = document.querySelector(`.date`).textContent.split(` `)[2];

    const response = await fetch(`./assets/data/nice-to-know.json`);
    const facts = await response.json();
    const fact = facts.filter(fact => fact.year == year)[0].fact;

    document.querySelector(`.fact`).textContent = fact;
  }

  const handleChangeFilter = e => {
    const season = e.currentTarget.value;
    const path = window.location.href.split(`?`)[0];
    const qs = `?season=${season}`;
    getEpisodes(`${path}${qs}`);
  };

  const getEpisodes = async url => {
    const response = await fetch(url, {
      headers: new Headers({
        Accept: 'application/json'
      })
    });
    const episodes = await response.json();
    window.history.pushState({},``, url);
    showEpisodes(episodes);
  };

  const showEpisodes = episodes => {
    const $parent = document.querySelector(`.episodes`);
    $parent.innerHTML = ``;
    episodes.forEach(episode => {
      $parent.innerHTML += `<li class="episodes__episode"><a href="index.php?page=detail&id=${episode.id}">${episode.title}</a></li>`;
    });
  }

  const init = () => {
    document.documentElement.classList.add('has-js');

    const $season = document.querySelector(`.filter-season`);
    if($season){
      $season.addEventListener(`change`,handleChangeFilter);
    }

    const $date = document.querySelector(`.date`);
    if($date){
      showFact();
    }
  };

  init();
}
