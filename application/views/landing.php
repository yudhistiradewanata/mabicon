<!DOCTYPE html>
<html lang="id-ID" style="--vh: 8.13px;">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preload" href="<?= base_url('assets/landing/manrope-700.woff2')?>" as="font" type="font/woff2" crossorigin="">
    <link rel="preload" href="<?= base_url('assets/landing/noto-sans-400.woff2')?>" as="font" type="font/woff2" crossorigin="">
    <link rel="preload" href="<?= base_url('assets/landing/noto-sans-500.woff2')?>" as="font" type="font/woff2" crossorigin="">
    <link rel="preload" href="<?= base_url('assets/landing/noto-sans-600.woff2')?>" as="font" type="font/woff2" crossorigin="">
    
    <title>Broker Forex Terbaik dan Terpercaya di Indonesia – Mabicon</title>
    <style>
      .account-offer{
        max-width: 250px;
        margin:15px;
      }
      .button--primary {
          background-color: #e02328 !important;
          color: white !important;
      }
      .button--border{
        background-color: initial !important;
        color: initial !important;
      }
      .whatsapp-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            background-color: #25d366;
            border-radius: 50%;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            transition: transform 0.3s;
        }

        .whatsapp-button:hover {
            transform: scale(1.1);
        }

        .whatsapp-button img {
            width: 35px;
            height: 35px;
        }
    </style>
    <meta name="description" content="Broker Forex terpercaya di Indonesia, terdaftar di BAPPEBTI. Trading Forex online: emas, mata uang, CFD. Spread rendah, komisi kecil, perlindungan saldo negatif.">
    <meta name="format-detection" content="telephone=no">
    <meta name="facebook-domain-verification" content="y9lw81l55d4tuwm24xtqr7gbr0qt87">
    <meta name="HandheldFriendly" content="true">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#fff">
    <meta name="application-name" content="Mabicon">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Mabicon">
    <meta name="msapplication-TileColor" content="#fff">
    <meta name="msapplication-config" content="/meta-icons/browserconfig.xml">
    <meta property="og:type" content="website">
    <meta property="og:description" content="Broker Forex terpercaya di Indonesia, terdaftar di BAPPEBTI. Trading Forex online: emas, mata uang, CFD. Spread rendah, komisi kecil, perlindungan saldo negatif.">
    <meta property="og:url" content="https://mabicontech.com/">
    <meta property="og:site_name" content="Mabicon">
    <meta property="og:title" content="Mabicon">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:type" content="website">
    <meta name="twitter:description" content="Broker Forex terpercaya di Indonesia, terdaftar di BAPPEBTI. Trading Forex online: emas, mata uang, CFD. Spread rendah, komisi kecil, perlindungan saldo negatif.">
    <meta name="twitter:title" content="Mabicon">
    <link type="image/x-icon" href="<?=base_url('assets/landing/favicon.png')?>" rel="shortcut icon">
    
    <link href="<?=base_url('assets/landing/main_page.min.css')?>" rel="stylesheet"> 
  </head>

<body id="body">
  <div class="wrapper">
    
    <header class="header js-header">
        <div class="header__inner">
            <div class="header__title">
                <a class="header__logo" href="https://mabicontech.com/" aria-label="To main page">
                    <img src="<?=base_url('assets/images/logo.webp')?>" width="137" height="32" alt="Mabicon logo">
                </a>
                
            </div>
            <div class="header__menu">
                <nav class="header__nav">
                    <ul class="header__nav-list">
                        <li class="header__nav-item">
                            <a class="header__nav-link" href="#home-section">Home</a>
                        </li>
                        <li class="header__nav-item">
                            <a class="header__nav-link" href="#why-us-section">About Us</a>
                        </li>
                        <li class="header__nav-item">
                            <a class="header__nav-link" href="#instrument-section">Instrument</a>
                        </li>
                        <li class="header__nav-item">
                            <a class="header__nav-link" href="#platform-section">Platform</a>
                        </li>
                        <li class="header__nav-item">
                            <a class="header__nav-link" href="#account-section">Account Type</a>
                        </li>
                        <li class="header__nav-item">
                            <a class="header__nav-link" href="#contact-section">Contact Us</a>
                        </li>
                    </ul>
                </nav>
                <div class="header__menu-buttons hidden--lg">
                    <a class="button button--secondary button--lg button--wide" href="<?=site_url('member/auth/login')?>" target="_blank">
                        <span class="button__content">Sign In</span>
                    </a>
                    <a class="button button--primary button--lg button--wide" href="<?= site_url('member/auth/register')?>" target="_blank">
                        <span class="button__content">Create Account</span>
                    </a>
                </div>
                <div class="header__social hidden--lg">
                    <span class="header__social-title"></span>
                    <ul class="header__social-list">
                        
                    </ul>
                </div>
            </div>
            <div class="header__controls">
                <div class="header__buttons">
                    <a class="button button--secondary button--sm hidden--sm-only" href="<?=site_url('member/auth/login')?>" target="_blank">
                        <span class="button__content">
                          Sign In                    </span>
                    </a>
                    <a class="button button--primary button--sm" href="<?= site_url('member/auth/register')?>" target="_blank">
                        <span class="button__content">
                          Create Account                    </span>
                    </a>
                </div>
                <button class="header__toggle hidden--lg js-header-toggle" aria-label="Toggle header menu" type="button">
                    <span class="header__toggle-open">
                        <svg width="24" height="24" aria-hidden="true">
                            <use xlink:href="<?=base_url('assets/landing/media/svg/sprites.svg#menu')?>"></use>
                        </svg>
                    </span>
                    <span class="header__toggle-close">
                        <svg width="24" height="24" aria-hidden="true">
                            <use xlink:href="<?=base_url('assets/landing/media/svg/sprites.svg#cross-small')?>"></use>
                        </svg>
                    </span>
                </button>
            </div>
        </div>
    </header>

    <main class="main">
      <div class="page">
        <div class="page__content">
          <div class="container container--not-sm" id="home-section">
            <div class="hero-banner hero-banner--grey">
              <div class="hero-banner__content" style="grid-column:span 6!important;">
                <div class="hero-banner__text">
                  <h1 class="hero-banner__title h1">MABICON </h1>
                  <b>CFD Premier Asia Trading Broker House</b>
                  <p class="hero-banner__description hero-banner__description--min">Start trading with spreads as low as <b>0.1</b> pips.<br>Minimum deposit of only <b>$10.</b></p>
                </div>
                <div class="hero-banner__buttons">
                  <a class="button button--primary button--lg" target="_blank" href="<?= site_url('member/auth/register')?>">
                    <span class="button__content">
                      Open Account</span>
                  </a>
                  <a class="button button--primary button--border button--lg" target="_blank" href="<?= site_url('member/auth/login')?>">
                    <span class="button__content">
                      Log In</span>
                  </a>
                </div>
              
              </div>
              <div class="hero-banner__image" style="grid-column:span 6!important;">
                <!-- <picture> -->
                  <img src="<?=base_url('assets/landing/images/banner.png')?>" alt="">
                <!-- </picture> -->
              </div>
            </div>
          </div>

          <section class="section" id="why-us-section">
            <div class="section__inner container">
              <h2 class="section__title h2">Why choose Mabicon?</h2>
              <div class="section__content">
                <div class="cards-grid">
                  <div class="cards-grid__item cards-grid__item--big">
                    <figure class="feature-card feature-card--big">
                      <figcaption class="feature-card__text">
                        <h3 class="feature-card__title">Safe deposits and withdrawals </h3>
                        <p class="feature-card__description">Deposit 24/7 via USDT Account and trade with a licensed broker.</p>
                      </figcaption>
                      <div class="feature-card__image">
                        <picture>
                          <img src="<?=base_url('assets/landing/images/card1.webp')?>" srcset="<?=base_url('assets/landing/images/card1.webp')?>" width="360" height="330" alt="Secure deposits and withdrawals" loading="lazy">
                        </picture>
                      </div>
                    </figure>
                  </div>
                  <div class="cards-grid__item">
                    <figure class="feature-card">
                      <figcaption class="feature-card__text">
                        <h3 class="feature-card__title">Beneficial trading conditions</h3>
                        <p class="feature-card__description">
                            Low Spreads.<br>No Hidden Fee.<br>Minimum deposit of only 100$.</p>
                      </figcaption>
                      <div class="feature-card__image">
                        <picture>
                          <img src="<?=base_url('assets/landing/images/card2.webp')?>" srcset="<?=base_url('assets/landing/images/card2.webp')?>" width="224" height="206" alt="Profitable trading conditions" loading="lazy">
                        </picture>
                      </div>
                    </figure>
                  </div>
                  <div class="cards-grid__item">
                    <figure class="feature-card">
                      <figcaption class="feature-card__text">
                        <h3 class="feature-card__title">
                            Demo trading                    </h3>
                        <p class="feature-card__description">
                            Same conditions as real accounts.<br>Unlimited virtual funds.<br>Risk-free trading simulation. </p>
                      </figcaption>
                      <div class="feature-card__image">
                        <picture>
                          <img src="<?=base_url('assets/landing/images/card3.webp')?>" srcset="<?=base_url('assets/landing/images/card3.webp')?>" width="224" height="206" alt="Demo trading" loading="lazy">
                        </picture>
                      </div>
                    </figure>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <section class="section">
            <div class="section__inner container">
              <h2 class="section__title section__title--sm-align-left h2">
                  Mabicon Statistic</h2>
              <div class="section__content">
                <div class="advantages">
                  <ul class="advantages__list advantages__list--col-3">
                    <li class="advantages__item">
                      <div class="advantage-card">
                        
                        <div class="advantage-card__text">
                          <h3 class="advantage-card__title">
                              10+ years in the market</h3>
                          <p class="advantage-card__description">
                              Mabicon Broker was established in 2012. </p>
                        </div>
                      </div>
                    </li>
                    <li class="advantages__item">
                      <div class="advantage-card">
                        <div class="advantage-card__text">
                          <h3 class="advantage-card__title">
                              78 trading assets </h3>
                          <p class="advantage-card__description">
                              Forex, stocks, metals, and more.</p>
                        </div>
                      </div>
                    </li>
                    <li class="advantages__item">
                      <div class="advantage-card">
                        <div class="advantage-card__text">
                          <h3 class="advantage-card__title">
                              24/7 support </h3>
                          <p class="advantage-card__description">
                              Through LiveChat, email, and WhatsApp. </p>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </section>

          <section class="section" id="deposit-wd-section">
            <div class="section__inner container">
              <div class="section__main">
                <div class="section__header">
                  <h2 class="h2">Quick & easy deposits and withdrawals</h2>
                  <div class="grid-sm">
                  </div>
                </div>
                <div class="benefits">
                  <ul class="benefits__list">
                    <li class="benefits__item">
                      <span class="benefits__item-icon">
                        <svg width="24" height="24" aria-hidden="true">
                          <use xlink:href="<?=base_url('assets/landing/media/svg/sprites.svg#percent')?>"></use>
                        </svg>
                      </span>
                      <div class="benefits__item-text">
                        <p class="benefits__item-title">0% commission for deposits/withdrawals </p>
                      </div>
                    </li>
                    <li class="benefits__item">
                      <span class="benefits__item-icon">
                        <svg width="24" height="24" aria-hidden="true">
                          <use xlink:href="<?=base_url('assets/landing/media/svg/sprites.svg#clock')?>"></use>
                        </svg>
                      </span>
                      <div class="benefits__item-text">
                        <p class="benefits__item-title">80% of withdrawals processed within 20 minutes to 2 hours. </p>
                        <span class="benefits__item-caption">This may take longer on weekends and holidays.</span>
                      </div>
                    </li>
                    <li class="benefits__item">
                      <span class="benefits__item-icon">
                        <svg width="24" height="24" aria-hidden="true">
                          <use xlink:href="<?=base_url('assets/landing/media/svg/sprites.svg#arrow-circle-up')?>"></use>
                        </svg>
                      </span>
                      <div class="benefits__item-text">
                        <p class="benefits__item-title">Minimum withdrawal is $1.</p>
                        <span class="benefits__item-caption">No daily withdrawal limits </span>
                      </div>
                    </li>
                    <li class="benefits__item">
                      <span class="benefits__item-icon">
                        <svg width="24" height="24" aria-hidden="true">
                          <use xlink:href="<?=base_url('assets/landing/media/svg/sprites.svg#arrow-circle-down')?>"></use>
                        </svg>
                      </span>
                      <div class="benefits__item-text">
                        <p class="benefits__item-title">
                          Deposits processed starting from 1 hour</p>
                        <span class="benefits__item-caption">This may take longer on weekends and holidays.</span>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="section__media">
                <figure class="figure">
                  <figcaption class="figure__caption">
                    No need for bank account.<br>Deposit and withdraw your balance via USDT Address </figcaption>
                  <div class="figure__image">
                    <picture>
                      
                      <img src="<?=base_url('assets/landing/images/usdt.jpeg')?>" srcset="<?=base_url('assets/landing/images/usdt.jpeg')?>" width="282" height="284" alt="USDT logo" loading="lazy">
                    </picture>
                  </div>
                </figure>
              </div>
            </div>
          </section>

          <div class="container container--not-sm" id="account-section">
            <section class="content-wrapper content-wrapper--dark" style="padding:10px 0px 10px 0px;">
              <div class="content-wrapper__header">
                <h2 class="content-wrapper__title h2">Account Types</h2>
              </div>
              <div class="content-wrapper__content" style="padding:10px;">
                <article class="account-offer">
                  <div class="account-offer__head">
                    <h3 class="h4">
                      <span class="account-offer__link">ECN<span class="account-offer__link-icon">
                          <svg width="24" height="24" aria-hidden="true">
                            <use xlink:href="<?=base_url('assets/landing/media/svg/sprites.svg#chevron-right')?>"></use>
                          </svg>
                        </span>
                      </span>
                    </h3>
                  </div>
                  <div class="account-offer__body">
                    <dl class="account-offer__params">
                      <div class="account-offer__params-item">
                        <dt class="account-offer__params-title">Min. Deposit</dt>
                        <dd class="account-offer__params-value">$10</dd>
                      </div>
                      <div class="account-offer__params-item">
                        <dt class="account-offer__params-title">Stop Out Level</dt>
                        <dd class="account-offer__params-value">20%</dd>
                      </div>
                      <div class="account-offer__params-item">
                        <dt class="account-offer__params-title">Commission</dt>
                        <dd class="account-offer__params-value">1$</dd>
                      </div>
                      <div class="account-offer__params-item">
                        <dt class="account-offer__params-title">Leverage</dt>
                        <dd class="account-offer__params-value">1:1000
                          <button class="account-offer__params-icon js-tooltip" data-template-id="account-offer-tooltip" data-placement="bottom" aria-label="Leverage tooltip info" type="button" data-initialized="true" aria-expanded="false">
                            <svg width="20" height="20" aria-hidden="true">
                              <use xlink:href="<?=base_url('assets/landing/media/svg/sprites.svg#info')?>"></use>
                            </svg>
                          </button>
                        </dd>
                      </div>
                      <div class="account-offer__params-item">
                        <dt class="account-offer__params-title">Min. Trading Volume</dt>
                        <dd class="account-offer__params-value">Mulai 0,01 lot</dd>
                      </div>
                      <div class="account-offer__params-item">
                        <dt class="account-offer__params-title">Spread</dt>
                        <dd class="account-offer__params-value">From 1.6</dd>
                      </div>
                    </dl>
                  </div>
                  <div class="account-offer__buttons">
                    <a class="button button--primary button--lg" target="_blank" href="<?= site_url('member/auth/register')?>">
                      <span class="button__content">Create Account</span>
                    </a>
                  </div>
                </article>
              </div>
            </section>
          </div>

          <section class="section" id="instrument-section">
            <div class="container">
              <div class="section__header">
                <h2 class="h2">Trading Instrument </h2>
                <div class="grid-sm">
                  <p>Thousands of trading instruments available with low spreads and fast order execution </p>
                  <a class="link link--icon" href="#">
                    <span class="link__text">Learn more about instruments</span>
                    <span class="link__icon">
                        <svg width="20" height="20" aria-hidden="true">
                          <use xlink:href="<?=base_url('assets/landing/media/svg/sprites.svg#chevron-right')?>"></use>
                        </svg>
                      </span>
                  </a>
                </div>
              </div>
              <div class="section__content">
                  <div class="instruments js-instruments">
                  <div class="instruments__chips js-instruments-tabs">
                    <button class="instruments__chips-item js-instruments-tab hidden" data-type="all" type="button">
                      <span class="instruments__chips-text">
                        Semua        </span>
                      <sup class="instruments__chips-counter js-instruments-tab-counter">78</sup>
                    </button>
                    <button class="instruments__chips-item js-instruments-tab active" data-type="forex" type="button">
                      <span class="instruments__chips-text">
                        Forex        </span>
                      <sup class="instruments__chips-counter js-instruments-tab-counter">27</sup>
                    </button>
                    <button class="instruments__chips-item js-instruments-tab" data-type="metals" type="button">
                      <span class="instruments__chips-text">
                        Logam &amp; Energi        </span>
                      <sup class="instruments__chips-counter js-instruments-tab-counter">3</sup>
                    </button>
                    <button class="instruments__chips-item js-instruments-tab" data-type="indices" type="button">
                      <span class="instruments__chips-text">
                        Indeks        </span>
                      <sup class="instruments__chips-counter js-instruments-tab-counter">7</sup>
                    </button>
                    <button class="instruments__chips-item js-instruments-tab" data-type="stocks" type="button">
                      <span class="instruments__chips-text">
                        Saham        </span>
                      <sup class="instruments__chips-counter js-instruments-tab-counter">41</sup>
                    </button>
                  </div>
                  <div class="instruments__search">
                    <label class="search-input">
                      <span class="search-input__icon">
                        <svg width="24" height="24">
                          <use xlink:href="<?=base_url('assets/landing/media/svg/sprites.svg#search')?>"></use>
                        </svg>
                      </span>
                      <input class="js-instruments-search" name="trading-instruments-search" placeholder="Cari" type="search">
                      <button class="search-input__clear js-instruments-clear" aria-label="Clear instruments search" type="button">
                        <svg width="16" height="16">
                          <use xlink:href="<?=base_url('assets/landing/media/svg/sprites.svg#cross-small')?>"></use>
                        </svg>
                      </button>
                    </label>
                  </div>
                  <div class="instruments__table-wrapper js-instruments-table">
                    <table class="instruments__table">
                      <thead class="instruments__table-head syncscroll" name="table-scroll">
                      <tr class="instruments__table-row">
                        <th class="instruments__table-heading">Instrumen</th>
                        <th class="instruments__table-heading">Ukuran Tick</th>
                        <th class="instruments__table-heading">Spread Umum</th>
                        <th class="instruments__table-heading">Komisi</th>
                        <th class="instruments__table-heading">Stop Level</th>
                        <th class="instruments__table-heading">Ukuran Kontrak</th>
                      </tr>
                      </thead>
                      <tbody class="instruments__table-body js-instruments-table-body syncscroll" name="table-scroll" style="max-height: 1754px;">
                      <tr class="instruments__table-row js-instruments-table-row">
                        <th class="instruments__table-data">
                          <div class="instruments__item js-tooltip" data-tippy-content="Dolar Australia / Dolar Kanada" data-theme="dark" data-placement="top" data-initialized="true" aria-expanded="false">
                            <span class="instruments__item-icon">
                              <img src="<?=base_url('assets/landing/AUDCAD.svg')?>" width="32" height="32" alt="" loading="lazy">
                            </span>
                            <div class="instruments__item-text">
                              <p class="instruments__item-name">
                                AUDCAD
                              </p>
                              <span class="instruments__item-description">
                                Dolar Australia / Dolar Kanada
                              </span>
                            </div>
                          </div>
                        </th>
                        <td class="instruments__table-data">0,00001</td>
                        <td class="instruments__table-data">0,00014</td>
                        <td class="instruments__table-data">$1,00</td>
                        <td class="instruments__table-data">0</td>
                        <td class="instruments__table-data">100.000</td>
                      </tr>
                      <tr class="instruments__table-row js-instruments-table-row">
                        <th class="instruments__table-data">
                          <div class="instruments__item js-tooltip" data-tippy-content="Dolar Australia / Franc Swiss" data-theme="dark" data-placement="top" data-initialized="true" aria-expanded="false">
                            <span class="instruments__item-icon">
                              <img src="<?=base_url('assets/landing/AUDCHF.svg')?>" width="32" height="32" alt="" loading="lazy">
                            </span>
                            <div class="instruments__item-text">
                              <p class="instruments__item-name">
                                AUDCHF
                              </p>
                              <span class="instruments__item-description">
                                Dolar Australia / Franc Swiss
                              </span>
                            </div>
                          </div>
                        </th>
                        <td class="instruments__table-data">0,00001</td>
                        <td class="instruments__table-data">0,00007</td>
                        <td class="instruments__table-data">$1,00</td>
                        <td class="instruments__table-data">0</td>
                        <td class="instruments__table-data">100.000</td>
                      </tr>
                      <tr class="instruments__table-row js-instruments-table-row">
                        <th class="instruments__table-data">
                          <div class="instruments__item js-tooltip" data-tippy-content="Dolar Australia / Yen Jepang" data-theme="dark" data-placement="top" data-initialized="true" aria-expanded="false">
                            <span class="instruments__item-icon">
                              <img src="<?=base_url('assets/landing/AUDJPY.svg')?>" width="32" height="32" alt="" loading="lazy">
                            </span>
                            <div class="instruments__item-text">
                              <p class="instruments__item-name">
                                AUDJPY
                              </p>
                              <span class="instruments__item-description">
                                Dolar Australia / Yen Jepang
                              </span>
                            </div>
                          </div>
                        </th>
                        <td class="instruments__table-data">0,001</td>
                        <td class="instruments__table-data">0,011</td>
                        <td class="instruments__table-data">$1,00</td>
                        <td class="instruments__table-data">0</td>
                        <td class="instruments__table-data">100.000</td>
                      </tr>
                      <tr class="instruments__table-row js-instruments-table-row">
                        <th class="instruments__table-data">
                          <div class="instruments__item js-tooltip" data-tippy-content="Dolar Australia / Dolar Selandia Baru" data-theme="dark" data-placement="top" data-initialized="true" aria-expanded="false">
                            <span class="instruments__item-icon">
                              <img src="<?=base_url('assets/landing/AUDNZD.svg')?>" width="32" height="32" alt="" loading="lazy">
                            </span>
                            <div class="instruments__item-text">
                              <p class="instruments__item-name">
                                AUDNZD
                              </p>
                              <span class="instruments__item-description">
                                Dolar Australia / Dolar Selandia Baru
                              </span>
                            </div>
                          </div>
                        </th>
                        <td class="instruments__table-data">0,00001</td>
                        <td class="instruments__table-data">0,00012</td>
                        <td class="instruments__table-data">$1,00</td>
                        <td class="instruments__table-data">0</td>
                        <td class="instruments__table-data">100.000</td>
                      </tr>
                      <tr class="instruments__table-row js-instruments-table-row">
                        <th class="instruments__table-data">
                          <div class="instruments__item js-tooltip" data-tippy-content="Dolar Australia / Dolar AS" data-theme="dark" data-placement="top" data-initialized="true" aria-expanded="false">
                            <span class="instruments__item-icon">
                              <img src="<?=base_url('assets/landing/AUDUSD.svg')?>" width="32" height="32" alt="" loading="lazy">
                            </span>
                            <div class="instruments__item-text">
                              <p class="instruments__item-name">
                                AUDUSD
                              </p>
                              <span class="instruments__item-description">
                                Dolar Australia / Dolar AS
                              </span>
                            </div>
                          </div>
                        </th>
                        <td class="instruments__table-data">0,00001</td>
                        <td class="instruments__table-data">0,00007</td>
                        <td class="instruments__table-data">$1,00</td>
                        <td class="instruments__table-data">0</td>
                        <td class="instruments__table-data">100.000</td>
                      </tr>
                      <tr class="instruments__table-row js-instruments-table-row">
                        <th class="instruments__table-data">
                          <div class="instruments__item js-tooltip" data-tippy-content="Dolar Kanada / Yen Jepang" data-theme="dark" data-placement="top" data-initialized="true" aria-expanded="false">
                            <span class="instruments__item-icon">
                              <img src="<?=base_url('assets/landing/CADJPY.svg')?>" width="32" height="32" alt="" loading="lazy">
                            </span>
                            <div class="instruments__item-text">
                              <p class="instruments__item-name">
                                CADJPY
                              </p>
                              <span class="instruments__item-description">
                                Dolar Kanada / Yen Jepang
                              </span>
                            </div>
                          </div>
                        </th>
                        <td class="instruments__table-data">0,001</td>
                        <td class="instruments__table-data">0,013</td>
                        <td class="instruments__table-data">$1,00</td>
                        <td class="instruments__table-data">0</td>
                        <td class="instruments__table-data">100.000</td>
                      </tr>
                      <tr class="instruments__table-row js-instruments-table-row">
                        <th class="instruments__table-data">
                          <div class="instruments__item js-tooltip" data-tippy-content="Franc Swiss / Yen Jepang" data-theme="dark" data-placement="top" data-initialized="true" aria-expanded="false">
                            <span class="instruments__item-icon">
                              <img src="<?=base_url('assets/landing/CHFJPY.svg')?>" width="32" height="32" alt="" loading="lazy">
                            </span>
                            <div class="instruments__item-text">
                              <p class="instruments__item-name">
                                CHFJPY
                              </p>
                              <span class="instruments__item-description">
                                Franc Swiss / Yen Jepang
                              </span>
                            </div>
                          </div>
                        </th>
                        <td class="instruments__table-data">0,001</td>
                        <td class="instruments__table-data">0,015</td>
                        <td class="instruments__table-data">$1,00</td>
                        <td class="instruments__table-data">0</td>
                        <td class="instruments__table-data">100.000</td>
                      </tr>
                      <tr class="instruments__table-row js-instruments-table-row">
                        <th class="instruments__table-data">
                          <div class="instruments__item js-tooltip" data-tippy-content="Euro / Dolar Australia" data-theme="dark" data-placement="top" data-initialized="true" aria-expanded="false">
                            <span class="instruments__item-icon">
                              <img src="<?=base_url('assets/landing/EURAUD.svg')?>" width="32" height="32" alt="" loading="lazy">
                            </span>
                            <div class="instruments__item-text">
                              <p class="instruments__item-name">
                                EURAUD
                              </p>
                              <span class="instruments__item-description">
                                Euro / Dolar Australia
                              </span>
                            </div>
                          </div>
                        </th>
                        <td class="instruments__table-data">0,00001</td>
                        <td class="instruments__table-data">0,00011</td>
                        <td class="instruments__table-data">$1,00</td>
                        <td class="instruments__table-data">0</td>
                        <td class="instruments__table-data">100.000</td>
                      </tr>
                      <tr class="instruments__table-row js-instruments-table-row">
                        <th class="instruments__table-data">
                          <div class="instruments__item js-tooltip" data-tippy-content="Euro / Dolar Kanada" data-theme="dark" data-placement="top" data-initialized="true" aria-expanded="false">
                            <span class="instruments__item-icon">
                              <img src="<?=base_url('assets/landing/EURCAD.svg')?>" width="32" height="32" alt="" loading="lazy">
                            </span>
                            <div class="instruments__item-text">
                              <p class="instruments__item-name">
                                EURCAD
                              </p>
                              <span class="instruments__item-description">
                                Euro / Dolar Kanada
                              </span>
                            </div>
                          </div>
                        </th>
                        <td class="instruments__table-data">0,00001</td>
                        <td class="instruments__table-data">0,00011</td>
                        <td class="instruments__table-data">$1,00</td>
                        <td class="instruments__table-data">0</td>
                        <td class="instruments__table-data">100.000</td>
                      </tr>
                      <tr class="instruments__table-row js-instruments-table-row">
                        <th class="instruments__table-data">
                          <div class="instruments__item js-tooltip" data-tippy-content="Euro / Franc Swiss" data-theme="dark" data-placement="top" data-initialized="true" aria-expanded="false">
                            <span class="instruments__item-icon">
                              <img src="<?=base_url('assets/landing/EURCHF.svg')?>" width="32" height="32" alt="" loading="lazy">
                            </span>
                            <div class="instruments__item-text">
                              <p class="instruments__item-name">
                                EURCHF
                              </p>
                              <span class="instruments__item-description">
                                Euro / Franc Swiss
                              </span>
                            </div>
                          </div>
                        </th>
                        <td class="instruments__table-data">0,00001</td>
                        <td class="instruments__table-data">0,00013</td>
                        <td class="instruments__table-data">$1,00</td>
                        <td class="instruments__table-data">0</td>
                        <td class="instruments__table-data">100.000</td>
                      </tr>
                      <tr class="instruments__table-row js-instruments-table-row">
                        <th class="instruments__table-data">
                          <div class="instruments__item js-tooltip" data-tippy-content="Euro / Pound Inggris" data-theme="dark" data-placement="top" data-initialized="true" aria-expanded="false">
                            <span class="instruments__item-icon">
                              <img src="<?=base_url('assets/landing/EURGBP.svg')?>" width="32" height="32" alt="" loading="lazy">
                            </span>
                            <div class="instruments__item-text">
                              <p class="instruments__item-name">
                                EURGBP
                              </p>
                              <span class="instruments__item-description">
                                Euro / Pound Inggris
                              </span>
                            </div>
                          </div>
                        </th>
                        <td class="instruments__table-data">0,00001</td>
                        <td class="instruments__table-data">0,00008</td>
                        <td class="instruments__table-data">$1,00</td>
                        <td class="instruments__table-data">0</td>
                        <td class="instruments__table-data">100.000</td>
                      </tr>
                      <tr class="instruments__table-row js-instruments-table-row">
                        <th class="instruments__table-data">
                          <div class="instruments__item js-tooltip" data-tippy-content="Euro / Yen Jepang" data-theme="dark" data-placement="top" data-initialized="true" aria-expanded="false">
                            <span class="instruments__item-icon">
                              <img src="<?=base_url('assets/landing/EURJPY.svg')?>" width="32" height="32" alt="" loading="lazy">
                            </span>
                            <div class="instruments__item-text">
                              <p class="instruments__item-name">
                                EURJPY
                              </p>
                              <span class="instruments__item-description">
                                Euro / Yen Jepang
                              </span>
                            </div>
                          </div>
                        </th>
                        <td class="instruments__table-data">0,001</td>
                        <td class="instruments__table-data">0,009</td>
                        <td class="instruments__table-data">$1,00</td>
                        <td class="instruments__table-data">0</td>
                        <td class="instruments__table-data">100.000</td>
                      </tr>
                      <tr class="instruments__table-row js-instruments-table-row">
                        <th class="instruments__table-data">
                          <div class="instruments__item js-tooltip" data-tippy-content="Euro / Dolar Selandia Baru" data-theme="dark" data-placement="top" data-initialized="true" aria-expanded="false">
                            <span class="instruments__item-icon">
                              <img src="<?=base_url('assets/landing/EURNZD.svg')?>" width="32" height="32" alt="" loading="lazy">
                            </span>
                            <div class="instruments__item-text">
                              <p class="instruments__item-name">
                                EURNZD
                              </p>
                              <span class="instruments__item-description">
                                Euro / Dolar Selandia Baru
                              </span>
                            </div>
                          </div>
                        </th>
                        <td class="instruments__table-data">0,00001</td>
                        <td class="instruments__table-data">0,0002</td>
                        <td class="instruments__table-data">$1,00</td>
                        <td class="instruments__table-data">0</td>
                        <td class="instruments__table-data">100.000</td>
                      </tr>
                      <tr class="instruments__table-row js-instruments-table-row">
                        <th class="instruments__table-data">
                          <div class="instruments__item js-tooltip" data-tippy-content="Euro / Dolar AS" data-theme="dark" data-placement="top" data-initialized="true" aria-expanded="false">
                            <span class="instruments__item-icon">
                              <img src="<?=base_url('assets/landing/EURUSD.svg')?>" width="32" height="32" alt="" loading="lazy">
                            </span>
                            <div class="instruments__item-text">
                              <p class="instruments__item-name">
                                EURUSD
                              </p>
                              <span class="instruments__item-description">
                                Euro / Dolar AS
                              </span>
                            </div>
                          </div>
                        </th>
                        <td class="instruments__table-data">0,00001</td>
                        <td class="instruments__table-data">0,00005</td>
                        <td class="instruments__table-data">$1,00</td>
                        <td class="instruments__table-data">0</td>
                        <td class="instruments__table-data">100.000</td>
                      </tr>
                      <tr class="instruments__table-row js-instruments-table-row">
                        <th class="instruments__table-data">
                          <div class="instruments__item js-tooltip" data-tippy-content="Pound Inggris / Dolar Australia" data-theme="dark" data-placement="top" data-initialized="true" aria-expanded="false">
                            <span class="instruments__item-icon">
                              <img src="<?=base_url('assets/landing/GBPAUD.svg')?>" width="32" height="32" alt="" loading="lazy">
                            </span>
                            <div class="instruments__item-text">
                              <p class="instruments__item-name">
                                GBPAUD
                              </p>
                              <span class="instruments__item-description">
                                Pound Inggris / Dolar Australia
                              </span>
                            </div>
                          </div>
                        </th>
                        <td class="instruments__table-data">0,00001</td>
                        <td class="instruments__table-data">0,00015</td>
                        <td class="instruments__table-data">$1,00</td>
                        <td class="instruments__table-data">0</td>
                        <td class="instruments__table-data">100.000</td>
                      </tr>
                      <tr class="instruments__table-row js-instruments-table-row">
                        <th class="instruments__table-data">
                          <div class="instruments__item js-tooltip" data-tippy-content="Pound Inggris / Dolar Kanada" data-theme="dark" data-placement="top" data-initialized="true" aria-expanded="false">
                            <span class="instruments__item-icon">
                              <img src="<?=base_url('assets/landing/GBPCAD.svg')?>" width="32" height="32" alt="" loading="lazy">
                            </span>
                            <div class="instruments__item-text">
                              <p class="instruments__item-name">
                                GBPCAD
                              </p>
                              <span class="instruments__item-description">
                                Pound Inggris / Dolar Kanada
                              </span>
                            </div>
                          </div>
                        </th>
                        <td class="instruments__table-data">0,00001</td>
                        <td class="instruments__table-data">0,00019</td>
                        <td class="instruments__table-data">$1,00</td>
                        <td class="instruments__table-data">0</td>
                        <td class="instruments__table-data">100.000</td>
                      </tr>
                      <tr class="instruments__table-row js-instruments-table-row">
                        <th class="instruments__table-data">
                          <div class="instruments__item js-tooltip" data-tippy-content="Pound Inggris / Franc Swiss" data-theme="dark" data-placement="top" data-initialized="true" aria-expanded="false">
                            <span class="instruments__item-icon">
                              <img src="<?=base_url('assets/landing/GBPCHF.svg')?>" width="32" height="32" alt="" loading="lazy">
                            </span>
                            <div class="instruments__item-text">
                              <p class="instruments__item-name">
                                GBPCHF
                              </p>
                              <span class="instruments__item-description">
                                Pound Inggris / Franc Swiss
                              </span>
                            </div>
                          </div>
                        </th>
                        <td class="instruments__table-data">0,00001</td>
                        <td class="instruments__table-data">0,00015</td>
                        <td class="instruments__table-data">$1,00</td>
                        <td class="instruments__table-data">0</td>
                        <td class="instruments__table-data">100.000</td>
                      </tr>
                      <tr class="instruments__table-row js-instruments-table-row">
                        <th class="instruments__table-data">
                          <div class="instruments__item js-tooltip" data-tippy-content="Pound Inggris / Yen Jepang" data-theme="dark" data-placement="top" data-initialized="true" aria-expanded="false">
                            <span class="instruments__item-icon">
                              <img src="<?=base_url('assets/landing/GBPJPY.svg')?>" width="32" height="32" alt="" loading="lazy">
                            </span>
                            <div class="instruments__item-text">
                              <p class="instruments__item-name">
                                GBPJPY
                              </p>
                              <span class="instruments__item-description">
                                Pound Inggris / Yen Jepang
                              </span>
                            </div>
                          </div>
                        </th>
                        <td class="instruments__table-data">0,001</td>
                        <td class="instruments__table-data">0,011</td>
                        <td class="instruments__table-data">$1,00</td>
                        <td class="instruments__table-data">0</td>
                        <td class="instruments__table-data">100.000</td>
                      </tr>
                      <tr class="instruments__table-row js-instruments-table-row">
                        <th class="instruments__table-data">
                          <div class="instruments__item js-tooltip" data-tippy-content="Pound Inggris / Dolar Selandia Baru" data-theme="dark" data-placement="top" data-initialized="true" aria-expanded="false">
                            <span class="instruments__item-icon">
                              <img src="<?=base_url('assets/landing/GBPNZD.svg')?>" width="32" height="32" alt="" loading="lazy">
                            </span>
                            <div class="instruments__item-text">
                              <p class="instruments__item-name">
                                GBPNZD
                              </p>
                              <span class="instruments__item-description">
                                Pound Inggris / Dolar Selandia Baru
                              </span>
                            </div>
                          </div>
                        </th>
                        <td class="instruments__table-data">0,00001</td>
                        <td class="instruments__table-data">0,00027</td>
                        <td class="instruments__table-data">$1,00</td>
                        <td class="instruments__table-data">0</td>
                        <td class="instruments__table-data">100.000</td>
                      </tr>
                      <tr class="instruments__table-row js-instruments-table-row">
                        <th class="instruments__table-data">
                          <div class="instruments__item js-tooltip" data-tippy-content="Pound Inggris / Dolar AS" data-theme="dark" data-placement="top" data-initialized="true" aria-expanded="false">
                            <span class="instruments__item-icon">
                              <img src="<?=base_url('assets/landing/GBPUSD.svg')?>" width="32" height="32" alt="" loading="lazy">
                            </span>
                            <div class="instruments__item-text">
                              <p class="instruments__item-name">
                                GBPUSD
                              </p>
                              <span class="instruments__item-description">
                                Pound Inggris / Dolar AS
                              </span>
                            </div>
                          </div>
                        </th>
                        <td class="instruments__table-data">0,00001</td>
                        <td class="instruments__table-data">0,00005</td>
                        <td class="instruments__table-data">$1,00</td>
                        <td class="instruments__table-data">0</td>
                        <td class="instruments__table-data">100.000</td>
                      </tr>
                      <tr class="instruments__table-row js-instruments-table-row">
                        <th class="instruments__table-data">
                          <div class="instruments__item js-tooltip" data-tippy-content="Dolar Selandia Baru / Dolar Kanada" data-theme="dark" data-placement="top" data-initialized="true" aria-expanded="false">
                            <span class="instruments__item-icon">
                              <img src="<?=base_url('assets/landing/NZDCAD.svg')?>" width="32" height="32" alt="" loading="lazy">
                            </span>
                            <div class="instruments__item-text">
                              <p class="instruments__item-name">
                                NZDCAD
                              </p>
                              <span class="instruments__item-description">
                                Dolar Selandia Baru / Dolar Kanada
                              </span>
                            </div>
                          </div>
                        </th>
                        <td class="instruments__table-data">0,00001</td>
                        <td class="instruments__table-data">0,00012</td>
                        <td class="instruments__table-data">$1,00</td>
                        <td class="instruments__table-data">0</td>
                        <td class="instruments__table-data">100.000</td>
                      </tr>
                      <tr class="instruments__table-row js-instruments-table-row">
                        <th class="instruments__table-data">
                          <div class="instruments__item js-tooltip" data-tippy-content="Dolar Selandia Baru / Franc Swiss" data-theme="dark" data-placement="top" data-initialized="true" aria-expanded="false">
                            <span class="instruments__item-icon">
                              <img src="<?=base_url('assets/landing/NZDCHF.svg')?>" width="32" height="32" alt="" loading="lazy">
                            </span>
                            <div class="instruments__item-text">
                              <p class="instruments__item-name">
                                NZDCHF
                              </p>
                              <span class="instruments__item-description">
                                Dolar Selandia Baru / Franc Swiss
                              </span>
                            </div>
                          </div>
                        </th>
                        <td class="instruments__table-data">0,00001</td>
                        <td class="instruments__table-data">0,00009</td>
                        <td class="instruments__table-data">$1,00</td>
                        <td class="instruments__table-data">0</td>
                        <td class="instruments__table-data">100.000</td>
                      </tr>
                      <tr class="instruments__table-row js-instruments-table-row">
                        <th class="instruments__table-data">
                          <div class="instruments__item js-tooltip" data-tippy-content="Dolar Selandia Baru / Yen Jepang" data-theme="dark" data-placement="top" data-initialized="true" aria-expanded="false">
                            <span class="instruments__item-icon">
                              <img src="<?=base_url('assets/landing/NZDJPY.svg')?>" width="32" height="32" alt="" loading="lazy">
                            </span>
                            <div class="instruments__item-text">
                              <p class="instruments__item-name">
                                NZDJPY
                              </p>
                              <span class="instruments__item-description">
                                Dolar Selandia Baru / Yen Jepang
                              </span>
                            </div>
                          </div>
                        </th>
                        <td class="instruments__table-data">0,001</td>
                        <td class="instruments__table-data">0,015</td>
                        <td class="instruments__table-data">$1,00</td>
                        <td class="instruments__table-data">0</td>
                        <td class="instruments__table-data">100.000</td>
                      </tr>
                      <tr class="instruments__table-row js-instruments-table-row">
                        <th class="instruments__table-data">
                          <div class="instruments__item js-tooltip" data-tippy-content="Dolar Selandia Baru / Dolar AS" data-theme="dark" data-placement="top" data-initialized="true" aria-expanded="false">
                            <span class="instruments__item-icon">
                              <img src="<?=base_url('assets/landing/NZDUSD.svg')?>" width="32" height="32" alt="" loading="lazy">
                            </span>
                            <div class="instruments__item-text">
                              <p class="instruments__item-name">
                                NZDUSD
                              </p>
                              <span class="instruments__item-description">
                                Dolar Selandia Baru / Dolar AS
                              </span>
                            </div>
                          </div>
                        </th>
                        <td class="instruments__table-data">0,00001</td>
                        <td class="instruments__table-data">0,00009</td>
                        <td class="instruments__table-data">$1,00</td>
                        <td class="instruments__table-data">0</td>
                        <td class="instruments__table-data">100.000</td>
                      </tr>
                      <tr class="instruments__table-row js-instruments-table-row">
                        <th class="instruments__table-data">
                          <div class="instruments__item js-tooltip" data-tippy-content="Dolar AS / Dolar Kanada" data-theme="dark" data-placement="top" data-initialized="true" aria-expanded="false">
                            <span class="instruments__item-icon">
                              <img src="<?=base_url('assets/landing/USDCAD.svg')?>" width="32" height="32" alt="" loading="lazy">
                            </span>
                            <div class="instruments__item-text">
                              <p class="instruments__item-name">
                                USDCAD
                              </p>
                              <span class="instruments__item-description">
                                Dolar AS / Dolar Kanada
                              </span>
                            </div>
                          </div>
                        </th>
                        <td class="instruments__table-data">0,00001</td>
                        <td class="instruments__table-data">0,00008</td>
                        <td class="instruments__table-data">$1,00</td>
                        <td class="instruments__table-data">0</td>
                        <td class="instruments__table-data">100.000</td>
                      </tr>
                      <tr class="instruments__table-row js-instruments-table-row">
                        <th class="instruments__table-data">
                          <div class="instruments__item js-tooltip" data-tippy-content="Dolar AS / Franc Swiss" data-theme="dark" data-placement="top" data-initialized="true" aria-expanded="false">
                            <span class="instruments__item-icon">
                              <img src="<?=base_url('assets/landing/USDCHF.svg')?>" width="32" height="32" alt="" loading="lazy">
                            </span>
                            <div class="instruments__item-text">
                              <p class="instruments__item-name">
                                USDCHF
                              </p>
                              <span class="instruments__item-description">
                                Dolar AS / Franc Swiss
                              </span>
                            </div>
                          </div>
                        </th>
                        <td class="instruments__table-data">0,00001</td>
                        <td class="instruments__table-data">0,00006</td>
                        <td class="instruments__table-data">$1,00</td>
                        <td class="instruments__table-data">0</td>
                        <td class="instruments__table-data">100.000</td>
                      </tr>
                      <tr class="instruments__table-row js-instruments-table-row">
                        <th class="instruments__table-data">
                          <div class="instruments__item js-tooltip" data-tippy-content="Dolar AS / Yen Jepang" data-theme="dark" data-placement="top" data-initialized="true" aria-expanded="false">
                            <span class="instruments__item-icon">
                              <img src="<?=base_url('assets/landing/USDJPY.svg')?>" width="32" height="32" alt="" loading="lazy">
                            </span>
                            <div class="instruments__item-text">
                              <p class="instruments__item-name">
                                USDJPY
                              </p>
                              <span class="instruments__item-description">
                                Dolar AS / Yen Jepang
                              </span>
                            </div>
                          </div>
                        </th>
                        <td class="instruments__table-data">0,001</td>
                        <td class="instruments__table-data">0,006</td>
                        <td class="instruments__table-data">$1,00</td>
                        <td class="instruments__table-data">0</td>
                        <td class="instruments__table-data">100.000</td>
                      </tr></tbody>
                    </table>
                    <button class="instruments__expand-button js-instruments-expand button button--secondary button--adaptive button--wide active" type="button">
                      <span class="button__content js-instruments-more hidden">
                        Lihat lebih banyak        </span>
                      <span class="button__content js-instruments-less">
                        Tampilkan lebih sedikit        </span>
                      <span class="button__icon">
                        <svg width="20" height="20" aria-hidden="true">
                          <use xlink:href="<?=base_url('assets/landing/media/svg/sprites.svg#chevron-down')?>"></use>
                        </svg>
                      </span>
                    </button>
                  </div>
                  <figure class="instruments__placeholder js-instruments-placeholder hidden">
                    <div class="instruments__placeholder-image">
                      <img src="<?=base_url('assets/landing/nothing-found.svg')?>" width="232" height="160" alt="" loading="lazy">
                    </div>
                    <figcaption class="instruments__placeholder-text">
                      <b class="h4">
                        Hasil tidak ditemukan        </b>
                      <p class="instruments__placeholder-text">Coba ubah pencarian Anda</p>
                    </figcaption>
                  </figure>

                </div>
              </div>
            </div>
          </section>

          <section class="section" id="platform-section">
            <div class="section__inner container">
              <h2 class="section__title h2">Platform Trading</h2>
              <div class="section__content">
                <div class="tabs">
                  <div class="tabs__content">
                    <div class="tabs__panel">
                      <article class="app-banner">
                        <div class="app-banner__content">
                          <div class="app-banner__text">
                            <h3 class="app-banner__title h3">Optimize trading with MetaTrader 5</h3>
                            <p class="app-banner__description grid-sm">Trade and take advantage of the most advanced trading platform with enhanced features. <a class="link link--icon hidden--sm-only" target="_blank" href="<?= site_url('member/auth/register')?>">
                                <span class="link__text">Buka akun</span>
                                <span class="link__icon">
                                  <svg width="20" height="20" aria-hidden="true">
                                    <use xlink:href="<?=base_url('assets/landing/media/svg/sprites.svg#chevron-right')?>"></use>
                                  </svg>
                                </span>
                              </a>
                            </p>
                          </div>
                          <ul class="app-banner__links ">
                            <li class="app-banner__link app-banner__link--web ">
                              <a class="app-button app-button--dark app-button--appstore js-apple-link" target="_blank" href="https://apps.apple.com/us/app/metatrader-5/id413251709" aria-label="Download on the App Store">
                                <img class="app-button__icon " src="<?=base_url('assets/landing/app-store.svg')?>" width="148" height="44" alt="App Store" loading="lazy">
                              </a>
                            </li>
                            <li class="app-banner__link ">
                              <a class="app-button app-button--dark app-button--googleplay" target="_blank" href="https://play.google.com/store/apps/details?id=net.metaquotes.metatrader5" aria-label="Get it on Google Play">
                                <img class="app-button__icon" src="<?=base_url('assets/landing/google-play.svg')?>" width="148" height="44" alt="Google Play" loading="lazy">
                              </a>
                            </li>
                          </ul>
                        </div>
                        <div class="app-banner__image">
                          <picture>
                            <img src="<?=base_url('assets/landing/images/banner.png')?>"width="288" height="296" alt="" loading="lazy">
                          </picture>
                        </div>
                      </article>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <section class="section" id="contact-section  ">
            <div class="section__inner container" style="">
              <div class="section__main" style="grid-column:span 6;">
                <div class="section__header">
                  <h2 class="h2">Awards & Accolades</h2>
                  <div class="grid-sm">
                    <p>Mabicon has garnered numerous awards and accolades for its outstanding services and innovation in the financial trading industry. Our consistent dedication to excellence has earned us recognition from esteemed financial organizations and publications. We are proud to continue providing top-quality trading experiences and maintaining the highest standards in the industry. </p>
                  </div>
                </div>
                <div class="regulations regulations--large" style="">
                  <ul class="regulations__list">
                    <li class="regulations__item" style="height:80px;">
                      <picture>
                        <img src="<?=base_url('assets/landing/images/awards1.webp')?>" width="220" height="300" alt="Volume Multilateral Terbanyak II dari JFX" loading="lazy">
                      </picture>
                    </li>
                    <li class="regulations__item" style="height:80px;">
                      <picture>
                        <img src="<?=base_url('assets/landing/images/awards2.webp')?>" width="220" height="300" alt="Volume Multilateral Terbanyak II dari JFX" loading="lazy">
                      </picture>
                    </li>
                    <li class="regulations__item" style="height:80px;">
                      <picture>
                        <img src="<?=base_url('assets/landing/images/awards3.webp')?>" width="220" height="300" alt="Volume Multilateral Terbanyak II dari JFX" loading="lazy">
                      </picture>
                    </li>
                    <li class="regulations__item" style="height:80px;">
                      
                      <picture>
                        <img src="<?=base_url('assets/landing/images/awards4.webp')?>" width="220" height="300" alt="Volume Multilateral Terbanyak II dari JFX" loading="lazy">
                      </picture>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="section__content" style="grid-column:span 6;">
                <div class="contacts">
                  <div class="contacts__content" style="grid-column: span 12;">
                    <section class="contacts__section grid-md">
                      <h3 class="contacts__section-title">
                          Kontak                  </h3>
                      <address class="contacts__cards">
                        <p class="contacts__card">
                          <span class="contacts__card-title">WhatsApp dukungan</span>
                          <a class="link" href="https://wa.me/+60177855190" target="_blank">
                            +60177855190</a>
                        </p>
                        <p class="contacts__card">
                          <span class="contacts__card-title">Email</span>
                          <a class="link" href="mailto:cs@mabicontech.com">cs @mabicontech.com</a>
                        </p>
                      </address>
                    </section>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <section class="section">
            <div class="section__inner container">
              <h2 class="section__title h2">F.A.Q</h2>
              <div class="section__content">
                <div class="accordions">
                  <div class="accordions__item js-accordion">
                    <div class="accordions__head js-accordion-head">
                      <p class="accordions__head-title">Trading Forex vs. Trading Commodity </p>
                      <span class="accordions__head-icon">
                          <svg width="24" height="24">
                            <use xlink:href="<?=base_url('assets/landing/media/svg/sprites.svg#chevron-down')?>"></use>
                          </svg>
                        </span>
                    </div>
                    <div class="accordions__content js-accordion-content">
                      <div class="accordions__content-inner">
                        <div class="grid-md">
                          <p>
                            Trading Forex involves trading global currencies and leveraging currency value fluctuations to generate profit. Forex is influenced by interest rates, inflation, and global economic conditions. On the other hand, commodity trading focuses on buying and selling physical commodities like gold, oil, and agricultural products, which are affected by supply and demand. For example, a decrease in oil demand in China leads to a drop in global oil prices.
                            <br><br>
                            While both offer unique advantages, Forex trading is renowned for its liquidity due to high trading volumes. However, commodity trading can help diversify your portfolio. </p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="accordions__item js-accordion">
                    <div class="accordions__head js-accordion-head">
                      <h3 class="accordions__head-title">What is Forex Trading?</h3>
                      <span class="accordions__head-icon">
                          <svg width="24" height="24">
                            <use xlink:href="<?=base_url('assets/landing/media/svg/sprites.svg#chevron-down')?>"></use>
                          </svg>
                        </span>
                    </div>
                    <div class="accordions__content js-accordion-content">
                      <div class="accordions__content-inner">
                        <div class="grid-md">
                          <p>
                            Trading Forex, or foreign exchange trading, involves buying and selling currencies in the global market. Traders aim to profit from currency value fluctuations by making informed decisions based on market analysis. They buy when anticipating an increase in value and sell when predicting a decrease.</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="accordions__item js-accordion">
                    <div class="accordions__head js-accordion-head">
                      <h3 class="accordions__head-title">What is the Forex Market?</h3>
                      <span class="accordions__head-icon">
                          <svg width="24" height="24">
                            <use xlink:href="<?=base_url('assets/landing/media/svg/sprites.svg#chevron-down')?>"></use>
                          </svg>
                        </span>
                    </div>
                    <div class="accordions__content js-accordion-content">
                      <div class="accordions__content-inner">
                        <div class="grid-md">
                          <p>
                            The Forex market, also known as the foreign exchange market, is a decentralized marketplace for buying and selling currencies. Operating around the clock, five days a week, it is the most liquid market in the world. This global market facilitates currency conversion for trading, investment, and speculation, offering a wide range of opportunities for traders to leverage various currency pairs and strategies.</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="accordions__item js-accordion">
                    <div class="accordions__head js-accordion-head">
                      <h3 class="accordions__head-title">How to Start Trading with a Forex Broker?</h3>
                      <span class="accordions__head-icon">
                          <svg width="24" height="24">
                            <use xlink:href="<?=base_url('assets/landing/media/svg/sprites.svg#chevron-down')?>"></use>
                          </svg>
                        </span>
                    </div>
                    <div class="accordions__content js-accordion-content">
                      <div class="accordions__content-inner">
                        <div class="grid-md">
                          <p>
                            Starting Forex trading with a reliable broker like Mabicon is straightforward. Begin by creating an account on our platform. After verifying your identity and making a deposit, explore the available currency pairs and tools. Learn about market analysis, risk management, and trading strategies. Our intuitive interface allows you to execute trades, monitor positions, and follow the latest trends. You can rely on our professional support team to assist you every step of the way. At Mabicon, we are dedicated to traders, providing a safe, user-friendly, and comprehensive trading experience. Join us now to maximize your trading potential.
                            <br><br>
                            <b>Why Choose Mabicon?</b>
                            <br><br>
                            Choosing a reliable trading broker is crucial. Mabicon is the right choice for you. RMabicon secures all client funds ensuring the safety of personal data and invested funds.
                            <br>
                            With cutting-edge technology, robust security measures, and professional customer support, we offer transparent features and conditions needed for effective Forex and asset trading, whether you are an experienced trader or a beginner. Low spreads, easy deposit and withdrawal through major Indonesian banks, and fast order execution make your trading experience with Mabicon seamless.</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </main>
    <template id="account-offer-tooltip"></template>      
    <footer class="footer">
        <div class="footer__inner">
            <div class="footer__content">
                <div class="footer__header">
                    <div class="footer__contacts">
                        <a href="https://wa.me/+60177855190" class="footer__tel" target="_blank">
                            +60177855190                    </a>

                        <p class="footer__paragraph">
                            Layanan Nasabah                    </p>
                    </div>

                    <div class="footer__socials">
                        
                    </div>
                </div>
            </div>

            <div class="footer__content footer__content--multi">
                <div class="footer__nav">
                    <div class="footer__nav-item js-accordion" data-group="footer" data-breakpoint="sm-max">
                        <div class="footer__nav-head js-accordion-head">
                            <span>Trading</span>
                            <span class="footer__head-icon">
                                <svg width="24" height="24">
                                    <use xlink:href="<?=base_url('assets/landing/media/svg/sprites.svg#chevron-down')?>"></use>
                                </svg>
                            </span>
                        </div>

                        <div class="footer__nav-content js-accordion-content">
                            <div class="footer__nav-inner">
                                <a class="footer__nav-link" href="#account-section">Jenis Akun</a>
                                <a class="footer__nav-link" href="#instrument-section">Instrumen Trading</a>
                                <a class="footer__nav-link" href="#platform-section">Platform Trading</a>
                                <a class="footer__nav-link" href="#deposit-wd-section">Deposit dan Penarikan</a>
                            </div>
                        </div>
                    </div>

                    <div class="footer__nav-item js-accordion" data-group="footer" data-breakpoint="sm-max">
                        <div class="footer__nav-head js-accordion-head">
                            <span>Tentang Kami</span>
                            <span class="footer__head-icon">
                            <svg width="24" height="24">
                                <use xlink:href="<?=base_url('assets/landing/media/svg/sprites.svg#chevron-down')?>"></use>
                            </svg>
                        </span>
                        </div>

                        <div class="footer__nav-content js-accordion-content">
                            <div class="footer__nav-inner">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer__content">
                <div class="footer__info">
                    <div class="footer__risk">
                        <p class="footer__paragraph">
                          <b>Disclaimer:</b>
                          <br>
                          Mabicon (PTY) SA licensed by South Africa FSCA, FSP number 52698 and registration number 2022/562779/07 with registered office at 30 CRESTONE PEAK, MIDLANDS ESTATE, CENTURION 1692. The operating office is at Alice Lane, Phase 3, 4th Floor, Alice Lane, Sandhurst, Sandton, Gauteng, 2146, Johanesburg, ZA
                          <br><br>
                          Mabicon (PTY) Ltd does not issue advice, recommendations or opinions in relation to acquiring, holding or disposing of a CFD. Mabicon (PTY) Ltd is not a financial advisor and all services are provided on an execution-only basis. This communication is not an offer or solicitation to enter into a transaction and shall not be construed as such.
                          <br><br>
                          This website is not directed at any jurisdiction and is not intended for any use that would be contrary to local law or regulation. Services are not available for residents of Turkey and the United States of America
                          <br><br>
                          By using www.mabicontech.com you agree to use our cookies to enhance your experience.
                          <br><br>
                          Mabicon (PTY) Ltd, all right reserved <?=date("Y")?></p>
                    </div>

                    <div class="footer__license">
                        <p class="footer__paragraph footer__license-text"><b>Risk Warning:</b>
                          <br><br>
                          Mabicon (PTY) Ltd offers trading on Foreign Exchange (‘Forex’ or ‘FX’) and Contracts for Difference (‘CFDs’), which are complex financial products that are traded on margin. They carry a high level of risk since leverage can work both to your advantage and disadvantage. As a result, these products may not be suitable for all investors, as loss of all invested capital may occur. You should not risk more than you are prepared to lose. Before deciding to trade, you need to ensure that you understand the risks involved and consider your investment objectives and level of experience. Seek independent advice, if necessary.
                          </p>

                    </div>
                </div>
            </div>

            <div class="footer__content">
                <div class="footer__feedback">
                    <p class="footer__paragraph">Customer Support:</p>

                    <div class="footer__feedback-links">
                        <a class="footer__feedback-link" href="https://wa.me/+601778551908780038" target="_blank">+60177855190</a>

                        <a class="footer__feedback-link" href="mailto:cs@mabicontech.com" target="_blank">cs@mabicontech.com</a>

                    </div>
                </div>
            </div>

            <div class="footer__content ">
                <div class="footer__copyright">
                    <p class="footer__paragraph">© 2012—<?=date("Y")?> Mabicon.</p>
                </div>
            </div>
        </div>
    </footer>
  </div>
  <div class="whatsapp-button">
    <a href="https://wa.me/+60177855190" target="_blank">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp">
    </a>
  </div>
  <script src="<?=base_url('assets/landing/main_page.min.js')?>" defer="defer"></script>
</body>
</html>