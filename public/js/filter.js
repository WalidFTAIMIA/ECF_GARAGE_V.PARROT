let filter;

class Filter {
  constructor(element) {
    if (element === null) {
      return;
    }
    this.form = element.querySelector('.js-filter-form');
    this.content = element.querySelector('.js-filter-content');
    this.priceSlider = null;
    this.kmSlider = null;
    this.yearSlider = null;
    this.bindEvents();
    this.initSliders();
  }

  bindEvents() {
    this.form.addEventListener('submit', e => {
      e.preventDefault();
      this.loadForm();
    });

    const resetBtn = this.form.querySelector('button[type="reset"]');
    if (resetBtn) {
      resetBtn.addEventListener('click', () => this.resetForm());
    }
  }

  async loadForm(ignoreFilters = false) {
    let url;
    if (ignoreFilters) {
      // Charger sans filtres
      url = new URL(this.form.getAttribute('action') || window.location.href);
      url.searchParams.set('ajax', '1');
    } else {
      // Charger avec filtres
      const searchData = new FormData(this.form);
      url = new URL(this.form.getAttribute('action') || window.location.href);
      const params = new URLSearchParams(searchData);
      params.append('ajax', '1');
      url = url.pathname + '?' + params.toString();
    }

    const response = await fetch(url, {
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      }
    });

    if (response.ok) {
      const data = await response.json();
      this.content.innerHTML = data.content;
    } else {
      console.error(response);
    }
  }

  resetForm() {
    this.initSliders(true);
    this.form.reset();
    this.loadForm(true); // Charger sans filtres
  }

  initSliders(reset = false) {
    // Initialisation ou réinitialisation des sliders
    this.initializeSlider('price-slider', 'prixmin', 'prixmax', reset);
    this.initializeSlider('km-slider', 'kmmin', 'kmmax', reset);
    this.initializeSlider('year-slider', 'yearmin', 'yearmax', reset, true);
  }

  initializeSlider(sliderId, minInputId, maxInputId, reset, isYearSlider = false) {
    const sliderElement = document.getElementById(sliderId);
    if (!sliderElement) return;

    const minValueElement = document.getElementById(minInputId);
    const maxValueElement = document.getElementById(maxInputId);
    const minValue = reset ? parseInt(minValueElement.getAttribute('data-' + minInputId), 10) : parseInt(minValueElement.value, 10);
    const maxValue = reset ? parseInt(maxValueElement.getAttribute('data-' + maxInputId), 10) : parseInt(maxValueElement.value, 10);

    const step = isYearSlider ? 1 : 10;
    const minRangeValue = parseInt(sliderElement.dataset[minInputId], 10);
    const maxRangeValue = parseInt(sliderElement.dataset[maxInputId], 10);

    if (!this[sliderId]) {
      noUiSlider.create(sliderElement, {
        start: [minValue || minRangeValue, maxValue || maxRangeValue],
        connect: true,
        step: step,
        range: {
          'min': minRangeValue,
          'max': maxRangeValue
        }
      });

      sliderElement.noUiSlider.on('slide', function (values, handle) {
        if (handle === 0) {
          minValueElement.value = Math.round(values[0]);
        } else {
          maxValueElement.value = Math.round(values[1]);
        }
      });

      sliderElement.noUiSlider.on('end', () => this.loadForm());

      this[sliderId] = sliderElement.noUiSlider;
    } else {
      this[sliderId].updateOptions({
        start: [minValue || minRangeValue, maxValue || maxRangeValue]
      });
    }
  }
}

document.addEventListener('DOMContentLoaded', () => {
  filter = new Filter(document.querySelector('.js-filter'));
});
