<?php
declare(strict_types=1);
session_start();

require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../config/database.php';

$pdo = require __DIR__ . '/../config/database.php';
requireAuth();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../src/controllers/ProfileController.php';
    exit;
}
$user = getCurrentUser($pdo);

$errors = $errors ?? [];
$success = $success ?? '';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ITFREELANCE — Профиль исполнителя</title>
  <link rel="stylesheet" href="/assets/css/main.css">
  <style>

  </style>
</head>
<body class="page-profile-edit">
		<header class="profile-header">
			<div class="container container-header">
				<div class="bg__hero">
					<img class="bg__hero-img" src="/assets/images/bg.png" alt="фон" />
				</div>
				<a href="/" class="profile-header__logo"> <img src="/assets/images/Logo.png" alt="логотип" /> </a>
				<div class="profile-header__inner">
					<nav class="profile-header__nav">
						<a href="/orders.php" class="profile-header__link profile-header__link-order">Заказы</a>
						<a href="/catalog.php" class="profile-header__link">Исполнители</a>
					</nav>
					<div class="profile-header__actions">
						<button class="profile-header__btn profile-header__btn--notification">
							<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path
									fill-rule="evenodd"
									clip-rule="evenodd"
									d="M13.4164 0.679519C12.8151 1.46866 12.4504 2.39902 12.3616 3.37078C12.2727 4.34255 12.4629 5.31906 12.9118 6.19555C13.3608 7.07205 14.0515 7.81546 14.9099 8.34604C15.7683 8.87662 16.762 9.17434 17.7844 9.20728V9.21854C17.8005 9.42116 17.8166 9.62891 17.8381 9.82949C18.0924 12.129 18.672 13.7081 19.229 14.7447C19.5992 15.4355 19.963 15.894 20.2206 16.1713C20.3337 16.2936 20.4556 16.4082 20.5855 16.5142L20.5962 16.5203C20.7339 16.6156 20.8364 16.7501 20.889 16.9044C20.9416 17.0587 20.9415 17.2249 20.8888 17.3792C20.8361 17.5335 20.7335 17.6678 20.5957 17.763C20.4579 17.8582 20.292 17.9093 20.1219 17.909H0.803962C0.634181 17.9088 0.468811 17.8574 0.331501 17.7622C0.194191 17.667 0.0919724 17.5328 0.0394631 17.3789C-0.0130461 17.2249 -0.0131568 17.0591 0.0391469 16.905C0.0914506 16.751 0.19349 16.6167 0.330673 16.5213L0.339259 16.5142L0.407945 16.4589C0.472338 16.4036 0.57644 16.3105 0.705226 16.1713C0.962798 15.895 1.32662 15.4365 1.69688 14.7458C2.4374 13.3652 3.2187 11.032 3.2187 7.31711C3.2187 5.39215 3.96995 3.53677 5.32221 2.16136C6.67661 0.783903 8.52469 0 10.4629 0C10.8736 0 11.2789 0.0344535 11.6789 0.103361C11.9343 0.147366 12.7714 0.396045 13.4164 0.679519Z"
									fill="#1A1A1A"
								/>
								<path
									fill-rule="evenodd"
									clip-rule="evenodd"
									d="M8.20272 19.5474C8.29419 19.4969 8.3952 19.464 8.49998 19.4507C8.60477 19.4374 8.71128 19.4439 8.81343 19.4699C8.91558 19.4958 9.01137 19.5407 9.09533 19.6019C9.17929 19.6632 9.24978 19.7396 9.30277 19.8268C9.42073 20.0205 9.58998 20.1813 9.79358 20.2931C9.99718 20.4049 10.228 20.4637 10.4629 20.4637C10.6978 20.4637 10.9287 20.4049 11.1323 20.2931C11.3359 20.1813 11.5051 20.0205 11.6231 19.8268C11.6761 19.7396 11.7467 19.6632 11.8307 19.602C11.9147 19.5408 12.0106 19.4959 12.1128 19.47C12.215 19.4441 12.3215 19.4377 12.4263 19.4511C12.5312 19.4644 12.6322 19.4973 12.7236 19.5479C12.8151 19.5985 12.8952 19.6658 12.9594 19.7459C13.0236 19.8261 13.0707 19.9175 13.0978 20.0149C13.125 20.1124 13.1317 20.214 13.1177 20.3139C13.1037 20.4139 13.0692 20.5102 13.0161 20.5974C12.7567 21.024 12.3843 21.3781 11.9362 21.6243C11.4881 21.8704 10.9801 22 10.4629 22C9.94578 22 9.43772 21.8704 8.98963 21.6243C8.54153 21.3781 8.16914 21.024 7.90973 20.5974C7.85657 20.5101 7.82197 20.4137 7.80792 20.3137C7.79387 20.2137 7.80065 20.112 7.82786 20.0145C7.85508 19.917 7.90219 19.8255 7.96652 19.7454C8.03084 19.6652 8.11111 19.598 8.20272 19.5474Z"
									fill="#1A1A1A"
								/>
								<path
									d="M15.1296 1.12402C14.3749 1.84372 13.9509 2.81984 13.9509 3.83765C13.9509 4.85545 14.3749 5.83157 15.1296 6.55127C15.8844 7.27097 16.9081 7.67529 17.9754 7.67529C19.0428 7.67529 20.0665 7.27097 20.8212 6.55127C21.576 5.83157 22 4.85545 22 3.83765C22 2.81984 21.576 1.84372 20.8212 1.12402C20.0665 0.404322 19.0428 0 17.9754 0C16.9081 0 15.8844 0.404322 15.1296 1.12402Z"
									fill="#FFCB30"
								/>
							</svg>
						</button>
						<div class="profile-header__user"></div>
						<div class="profile-header__email">
							<a href="mailto:user@example.com" class="profile-header__email-link">
								<svg
									class="profile-header__email-icon"
									width="24"
									height="20"
									viewBox="0 0 24 20"
									fill="1A1A1A"
									xmlns="http://www.w3.org/2000/svg"
									aria-label="Email"
								>
									<path
										fill-rule="evenodd"
										clip-rule="evenodd"
										d="M1.172 1.25571C-7.94729e-08 2.51 0 4.53143 0 8.57143V11.4286C0 15.4686 -7.94729e-08 17.49 1.172 18.7443C2.34267 20 4.22933 20 8 20H16C19.7707 20 21.6573 20 22.828 18.7443C24 17.49 24 15.4686 24 11.4286V8.57143C24 4.53143 24 2.51 22.828 1.25571C21.6573 2.55448e-07 19.7707 0 16 0H8C4.22933 0 2.34267 2.55448e-07 1.172 1.25571ZM4.74 4.52571C4.44579 4.31544 4.08566 4.23899 3.73884 4.3132C3.39202 4.38742 3.08693 4.6062 2.89067 4.92143C2.69441 5.23666 2.62306 5.62251 2.69232 5.9941C2.76159 6.36569 2.96579 6.69258 3.26 6.90286L10.5213 12.0886C10.9593 12.4012 11.4738 12.568 12 12.568C12.5262 12.568 13.0407 12.4012 13.4787 12.0886L20.74 6.90286C21.0342 6.69258 21.2384 6.36569 21.3077 5.9941C21.3769 5.62251 21.3056 5.23666 21.1093 4.92143C20.9131 4.6062 20.608 4.38742 20.2612 4.3132C19.9143 4.23899 19.5542 4.31544 19.26 4.52571L12 9.71143L4.74 4.52571Z"
										fill="1A1A1A"
									/>
								</svg>
								<span class="profile-header__email-text"></span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</header>

		<main class="profile-main">
			<div class="container">
				<!-- <div class="flash-message success">Профиль успешно сохранён!</div> -->

				<form method="POST" action="/profile.php" enctype="multipart/form-data" class="profile-form" id="profileForm">
					<input type="hidden" name="csrf_token" value="test_token_123" />

					<div class="form-user">
						<!-- Основная информация -->
						<div class="profile-avatar-block">
							<h1 class="profile-section__title">Информация</h1>
							<div class="profile-avatar__wrapper" id="avatarDropZone">
								<img src="/assets/images/avatarBG.png" alt="Аватар" class="profile-avatar__image" id="avatarPreview" />
								<div class="profile-avatar__overlay"></div>
							</div>
							<button class="profile-avatar__btn">
								Загрузить
								<input
									type="file"
									name="avatar"
									id="avatarInput"
									accept="image/jpeg,image/png,image/webp"
									class="profile-avatar__input"
								/>
							</button>
						</div>
						<section class="profile-section--main">
							<!-- Имя Фамилия -->
							<div class="form-group">
								<label class="form-label" for="full_name"></label>
								<input
									type="text"
									id="full_name"
									name="full_name"
									value=""
									class="form-input"
									placeholder="Иван Иванов"
									required
								/>
							</div>

							<!-- Регион -->
							<div class="form-group form-group__region">
								<label class="form-label" for="region"></label>
								<select id="region" name="region" class="form-select" required>
									<option value="" selected>Регион</option>
									<option value="moscow">Москва</option>
									<option value="spb">Санкт-Петербург</option>
									<option value="kazan">Казань</option>
									<option value="novosibirsk">Пермь</option>
									<option value="ekaterinburg">Екатеринбург</option>
									<option value="other">Другой</option>
								</select>
							</div>
							<!-- Опыт работы -->
							<div class="form-group">
								<label class="form-label" for="experience"></label>
								<select id="experience" name="experience" class="form-select" required>
									<option value="" selected>Опыт работы</option>
									<option value="0-1">Менее 1 года</option>
									<option value="1-3">1–3 года</option>
									<option value="3-5">3–5 лет</option>
									<option value="5-10">5–10 лет</option>
									<option value="10+">Более 10 лет</option>
								</select>
							</div>

							<!-- Ставка -->
							<div class="form-group">
								<label class="form-label" for="rate"></label>
								<input
									type="number"
									id="rate"
									name="rate"
									value=""
									class="form-input"
									placeholder="Ставка, ₽/час"
									min="0"
									step="100"
								/>
							</div>

							<!-- Сфера деятельности -->
							<div class="form-group form-group--full">
								<label class="form-label" for="sphere"><span class="required"></span></label>
								<input
									type="text"
									id="sphere"
									name="sphere"
									value=""
									class="form-input"
									placeholder="Сфера деятельности"
									required
								/>
							</div>
						</section>

						<!-- Контакты -->
						<div class="profile-section--contacts">
							<div class="profile-fields__grid profile-fields__grid--3">
								<!-- Телефон -->
								<div class="form-group form-group--readonly">
									<label class="form-label" for="phone"></label>
									<input type="tel" id="phone" value="" class="form-input" placeholder="+7 (951) 955 59 99" readonly />
								</div>

								<!-- Email -->
								<div class="form-group form-group__email--readonly">
									<label class="form-label" for="email"></label>
									<input type="email" id="email" value="" class="form-input" placeholder="E-mail" readonly />
								</div>

								<!-- Сайт -->
								<div class="form-group">
									<label class="form-label" for="website"></label>
									<input type="url" id="website" name="website" value="" class="form-input" placeholder="Сайт" />
								</div>

								<!-- Телеграм -->
								<div class="form-group">
									<label class="form-label" for="telegram"></label>
									<input
										type="text"
										id="telegram"
										name="telegram"
										value=""
										class="form-input"
										placeholder="Телеграм"
									/>
								</div>

								<!-- Вконтакте -->
								<div class="form-group">
									<label class="form-label" for="vk"></label>
									<input type="text" id="vk" name="vk" value="" class="form-input" placeholder="Вконтакте" />
								</div>
							</div>
						</div>
					</div>

					<!-- О себе -->
					<section class="profile-section profile-section--about">
						<h2 class="profile-section__title">Обо мне</h2>
						<div class="form-group form-group__about">
							<textarea id="about" name="about" class="form-textarea" placeholder="О себе" rows="6"></textarea>
							<div class="form-textarea__counter"><span id="aboutCounter">0</span> / 500</div>
						</div>

						<!-- Навыки -->
						<div class="profile-section--skills">
							<div class="checkbox-grid" id="skills-container">
								<div class="form-group form-group--skills">
									<label class="form-label" for="skills"><span class="required"></span></label>
									<input
										type="text"
										id="skills"
										name="skills"
										value=""
										class="form-input"
										placeholder="Навыки"
										required
									/>
								</div>
								<label class="checkbox-item">
									<input type="checkbox" name="skills[]" value="verstka" class="checkbox-input" checked />
									<span class="checkbox-custom"></span>
									<span class="checkbox-label">Верстка</span>
								</label>
								<label class="checkbox-item">
									<input type="checkbox" name="skills[]" value="adaptive" class="checkbox-input" checked />
									<span class="checkbox-custom"></span>
									<span class="checkbox-label">Адаптив</span>
								</label>
								<label class="checkbox-item">
									<input type="checkbox" name="skills[]" value="animation" class="checkbox-input" />
									<span class="checkbox-custom"></span>
									<span class="checkbox-label">Анимация</span>
								</label>
								<label class="checkbox-item">
									<input type="checkbox" name="skills[]" value="mobile" class="checkbox-input" />
									<span class="checkbox-custom"></span>
									<span class="checkbox-label">Мобильная разработка</span>
								</label>
								<label class="checkbox-item">
									<input type="checkbox" name="skills[]" value="uxui" class="checkbox-input" checked />
									<span class="checkbox-custom"></span>
									<span class="checkbox-label">UX/UI</span>
								</label>
								<label class="checkbox-item">
									<input type="checkbox" name="skills[]" value="webapps" class="checkbox-input" />
									<span class="checkbox-custom"></span>
									<span class="checkbox-label">Web-приложения</span>
								</label>
								<label class="checkbox-item">
									<input type="checkbox" name="skills[]" value="landing" class="checkbox-input" checked />
									<span class="checkbox-custom"></span>
									<span class="checkbox-label">Лендинги</span>
								</label>
								<label class="checkbox-item">
									<input type="checkbox" name="skills[]" value="multipage" class="checkbox-input" />
									<span class="checkbox-custom"></span>
									<span class="checkbox-label">Многостраничные сайты</span>
								</label>
								<label class="checkbox-item">
									<input type="checkbox" name="skills[]" value="branding" class="checkbox-input" />
									<span class="checkbox-custom"></span>
									<span class="checkbox-label">Брендинг</span>
								</label>
								<label class="checkbox-item">
									<input type="checkbox" name="skills[]" value="logos" class="checkbox-input" />
									<span class="checkbox-custom"></span>
									<span class="checkbox-label">Логотипы</span>
								</label>
							</div>
						</div>

						<!-- Инструменты -->
						<div class="profile-section--tools">
							<div class="checkbox-grid" id="tools-container">
								<div class="form-group form-group--full">
									<label class="form-label" for="sphere"><span class="required"></span></label>
									<input
										type="text"
										id="sphere"
										name="sphere"
										value=""
										class="form-input"
										placeholder="Инструменты"
										required
									/>
								</div>
								<label class="checkbox-item">
									<input type="checkbox" name="tools[]" value="figma" class="checkbox-input" checked />
									<span class="checkbox-custom"></span>
									<span class="checkbox-label">Figma</span>
								</label>
								<label class="checkbox-item">
									<input type="checkbox" name="tools[]" value="illustrator" class="checkbox-input" />
									<span class="checkbox-custom"></span>
									<span class="checkbox-label">Adobe Illustrator</span>
								</label>
								<label class="checkbox-item">
									<input type="checkbox" name="tools[]" value="photoshop" class="checkbox-input" checked />
									<span class="checkbox-custom"></span>
									<span class="checkbox-label">Adobe Photoshop</span>
								</label>
								<label class="checkbox-item">
									<input type="checkbox" name="tools[]" value="html" class="checkbox-input" checked />
									<span class="checkbox-custom"></span>
									<span class="checkbox-label">HTML</span>
								</label>
								<label class="checkbox-item">
									<input type="checkbox" name="tools[]" value="css" class="checkbox-input" checked />
									<span class="checkbox-custom"></span>
									<span class="checkbox-label">CSS</span>
								</label>
								<label class="checkbox-item">
									<input type="checkbox" name="tools[]" value="js" class="checkbox-input" checked />
									<span class="checkbox-custom"></span>
									<span class="checkbox-label">JS</span>
								</label>
								<label class="checkbox-item">
									<input type="checkbox" name="tools[]" value="react" class="checkbox-input" />
									<span class="checkbox-custom"></span>
									<span class="checkbox-label">React</span>
								</label>
								<label class="checkbox-item">
									<input type="checkbox" name="tools[]" value="vite" class="checkbox-input" />
									<span class="checkbox-custom"></span>
									<span class="checkbox-label">Vite</span>
								</label>
								<label class="checkbox-item">
									<input type="checkbox" name="tools[]" value="postgresql" class="checkbox-input" />
									<span class="checkbox-custom"></span>
									<span class="checkbox-label">PostgreSQL</span>
								</label>
								<label class="checkbox-item">
									<input type="checkbox" name="tools[]" value="cms" class="checkbox-input" />
									<span class="checkbox-custom"></span>
									<span class="checkbox-label">CMS</span>
								</label>
								<label class="checkbox-item">
									<input type="checkbox" name="tools[]" value="python" class="checkbox-input" />
									<span class="checkbox-custom"></span>
									<span class="checkbox-label">Python</span>
								</label>
								<label class="checkbox-item">
									<input type="checkbox" name="tools[]" value="java" class="checkbox-input" />
									<span class="checkbox-custom"></span>
									<span class="checkbox-label">Java</span>
								</label>
								<label class="checkbox-item">
									<input type="checkbox" name="tools[]" value="cpp" class="checkbox-input" />
									<span class="checkbox-custom"></span>
									<span class="checkbox-label">C++</span>
								</label>
								<label class="checkbox-item">
									<input type="checkbox" name="tools[]" value="csharp" class="checkbox-input" />
									<span class="checkbox-custom"></span>
									<span class="checkbox-label">C#</span>
								</label>
							</div>
						</div>
					</section>
					<!-- Портфолио -->
					<section class="profile-section profile-section--portfolio">
						<h2 class="profile-section__title">Портфолио</h2>
						<div class="portfolio-grid__wrapper">
							<div class="portfolio-grid" id="portfolioGrid">
								<svg
									class="portfolio-sub"
									width="475"
									height="384"
									viewBox="0 0 475 384"
									fill="none"
									xmlns="http://www.w3.org/2000/svg"
								>
									<g filter="url(#filter0_ddd_3456_24671)">
										<mask id="path-1-inside-1_3456_24671" fill="#fff">
											<path
												fill-rule="evenodd"
												clip-rule="evenodd"
												d="M452 46C463.046 46 472 54.9543 472 66V289C472 297.284 465.284 304 457 304H425C416.716 304 410 310.716 410 319V351C410 359.284 403.284 366 395 366H45C33.9543 366 25 357.046 25 346V66C25 54.9543 33.9543 46 45 46H452Z"
											/>
										</mask>
										<path
											d="M472 66H473C473 64.5988 472.863 63.2287 472.6 61.9027L471.619 62.0968L470.638 62.2908C470.875 63.4897 471 64.7298 471 66H472ZM468.631 54.8877L469.462 54.3314C467.929 52.0417 465.958 50.0706 463.669 48.5377L463.112 49.3687L462.556 50.1997C464.628 51.5871 466.413 53.3716 467.8 55.444L468.631 54.8877ZM455.903 46.3807L456.097 45.3997C454.771 45.1374 453.401 45 452 45V46V47C453.27 47 454.51 47.1245 455.709 47.3617L455.903 46.3807ZM452 46V45H446.913V46V47H452V46ZM436.737 46V45H426.562V46V47H436.737V46ZM416.388 46V45H406.212V46V47H416.388V46ZM396.038 46V45H385.862V46V47H396.038V46ZM375.688 46V45H365.512V46V47H375.688V46ZM355.337 46V45H345.162V46V47H355.337V46ZM334.987 46V45H324.812V46V47H334.987V46ZM314.637 46V45H304.462V46V47H314.637V46ZM294.287 46V45H284.112V46V47H294.287V46ZM273.937 46V45H263.762V46V47H273.937V46ZM253.587 46V45H243.412V46V47H253.587V46ZM233.237 46V45H223.062V46V47H233.237V46ZM212.887 46V45H202.712V46V47H212.887V46ZM192.537 46V45H182.362V46V47H192.537V46ZM172.187 46V45H162.012V46V47H172.187V46ZM151.837 46V45H141.662V46V47H151.837V46ZM131.488 46V45H121.313V46V47H131.488V46ZM111.138 46V45H100.963V46V47H111.138V46ZM90.7876 46V45H80.6126V46V47H90.7876V46ZM70.4376 46V45H60.2626V46V47H70.4376V46ZM50.0876 46V45H45V46V47H50.0876V46ZM45 46V45C43.5988 45 42.2287 45.1374 40.9027 45.3997L41.0967 46.3807L41.2908 47.3617C42.4897 47.1245 43.7298 47 45 47V46ZM33.8877 49.3687L33.3314 48.5377C31.0417 50.0706 29.0706 52.0417 27.5377 54.3314L28.3687 54.8877L29.1997 55.444C30.5871 53.3716 32.3716 51.5871 34.444 50.1997L33.8877 49.3687ZM25.3807 62.0968L24.3997 61.9027C24.1374 63.2287 24 64.5988 24 66H25H26C26 64.7298 26.1245 63.4897 26.3617 62.2908L25.3807 62.0968ZM25 66H24V71H25H26V66H25ZM25 81H24V91H25H26V81H25ZM25 101H24V111H25H26V101H25ZM25 121H24V131H25H26V121H25ZM25 141H24V151H25H26V141H25ZM25 161H24V171H25H26V161H25ZM25 181H24V191H25H26V181H25ZM25 201H24V211H25H26V201H25ZM25 221H24V231H25H26V221H25ZM25 241H24V251H25H26V241H25ZM25 261H24V271H25H26V261H25ZM25 281H24V291H25H26V281H25ZM25 301H24V311H25H26V301H25ZM25 321H24V331H25H26V321H25ZM25 341H24V346H25H26V341H25ZM25 346H24C24 347.401 24.1374 348.771 24.3997 350.097L25.3807 349.903L26.3617 349.709C26.1245 348.51 26 347.27 26 346H25ZM28.3687 357.112L27.5377 357.669C29.0706 359.958 31.0417 361.929 33.3314 363.462L33.8877 362.631L34.444 361.8C32.3716 360.413 30.5871 358.628 29.1997 356.556L28.3687 357.112ZM41.0968 365.619L40.9027 366.6C42.2287 366.863 43.5988 367 45 367V366V365C43.7298 365 42.4897 364.875 41.2908 364.638L41.0968 365.619ZM45 366V367H49.8611V366V365H45V366ZM59.5833 366V367H69.3056V366V365H59.5833V366ZM79.0278 366V367H88.75V366V365H79.0278V366ZM98.4722 366V367H108.194V366V365H98.4722V366ZM117.917 366V367H127.639V366V365H117.917V366ZM137.361 366V367H147.083V366V365H137.361V366ZM156.806 366V367H166.528V366V365H156.806V366ZM176.25 366V367H185.972V366V365H176.25V366ZM195.694 366V367H205.417V366V365H195.694V366ZM215.139 366V367H224.861V366V365H215.139V366ZM234.583 366V367H244.306V366V365H234.583V366ZM254.028 366V367H263.75V366V365H254.028V366ZM273.472 366V367H283.195V366V365H273.472V366ZM292.917 366V367H302.639V366V365H292.917V366ZM312.361 366V367H322.083V366V365H312.361V366ZM331.806 366V367H341.528V366V365H331.806V366ZM351.25 366V367H360.972V366V365H351.25V366ZM370.695 366V367H380.417V366V365H370.695V366ZM390.139 366V367H395V366V365H390.139V366ZM395 366V367C397.168 367 399.237 366.568 401.125 365.786L400.742 364.862L400.359 363.938C398.709 364.622 396.9 365 395 365V366ZM408.862 356.742L409.786 357.125C410.568 355.237 411 353.168 411 351H410H409C409 352.9 408.622 354.709 407.938 356.359L408.862 356.742ZM410 351H411V347H410H409V351H410ZM410 339H411V331H410H409V339H410ZM410 323H411V319H410H409V323H410ZM410 319H411C411 317.1 411.378 315.291 412.062 313.641L411.138 313.258L410.214 312.875C409.432 314.763 409 316.832 409 319H410ZM419.258 305.138L419.641 306.062C421.291 305.378 423.1 305 425 305V304V303C422.832 303 420.763 303.432 418.875 304.214L419.258 305.138ZM425 304V305H429V304V303H425V304ZM437 304V305H445V304V303H437V304ZM453 304V305H457V304V303H453V304ZM457 304V305C459.168 305 461.237 304.568 463.125 303.786L462.742 302.862L462.359 301.938C460.709 302.622 458.9 303 457 303V304ZM470.862 294.742L471.786 295.125C472.568 293.237 473 291.168 473 289H472H471C471 290.9 470.622 292.709 469.938 294.359L470.862 294.742ZM472 289H473V283.932H472H471V289H472ZM472 273.795H473V263.659H472H471V273.795H472ZM472 253.523H473V243.386H472H471V253.523H472ZM472 233.25H473V223.114H472H471V233.25H472ZM472 212.977H473V202.841H472H471V212.977H472ZM472 192.705H473V182.568H472H471V192.705H472ZM472 172.432H473V162.295H472H471V172.432H472ZM472 152.159H473V142.023H472H471V152.159H472ZM472 131.886H473V121.75H472H471V131.886H472ZM472 111.614H473V101.477H472H471V111.614H472ZM472 91.3408H473V81.2045H472H471V91.3408H472ZM472 71.0681H473V66H472H471V71.0681H472ZM472 66H474C474 64.5333 473.856 63.0982 473.581 61.7086L471.619 62.0968L469.657 62.4849C469.882 63.6202 470 64.7953 470 66H472ZM468.631 54.8877L470.293 53.775C468.688 51.3768 466.623 49.3124 464.225 47.7068L463.112 49.3687L462 51.0306C463.963 52.3454 465.655 54.0365 466.969 56.0003L468.631 54.8877ZM455.903 46.3807L456.291 44.4187C454.902 44.1438 453.467 44 452 44V46V48C453.205 48 454.38 48.1181 455.515 48.3427L455.903 46.3807ZM452 46V44H446.913V46V48H452V46ZM436.737 46V44H426.562V46V48H436.737V46ZM416.388 46V44H406.212V46V48H416.388V46ZM396.038 46V44H385.862V46V48H396.038V46ZM375.688 46V44H365.512V46V48H375.688V46ZM355.337 46V44H345.162V46V48H355.337V46ZM334.987 46V44H324.812V46V48H334.987V46ZM314.637 46V44H304.462V46V48H314.637V46ZM294.287 46V44H284.112V46V48H294.287V46ZM273.937 46V44H263.762V46V48H273.937V46ZM253.587 46V44H243.412V46V48H253.587V46ZM233.237 46V44H223.062V46V48H233.237V46ZM212.887 46V44H202.712V46V48H212.887V46ZM192.537 46V44H182.362V46V48H192.537V46ZM172.187 46V44H162.012V46V48H172.187V46ZM151.837 46V44H141.662V46V48H151.837V46ZM131.488 46V44H121.313V46V48H131.488V46ZM111.138 46V44H100.963V46V48H111.138V46ZM90.7876 46V44H80.6126V46V48H90.7876V46ZM70.4376 46V44H60.2626V46V48H70.4376V46ZM50.0876 46V44H45V46V48H50.0876V46ZM45 46V44C43.5333 44 42.0982 44.1438 40.7086 44.4187L41.0967 46.3807L41.4849 48.3427C42.6202 48.1181 43.7953 48 45 48V46ZM33.8877 49.3687L32.775 47.7068C30.3768 49.3124 28.3123 51.3768 26.7068 53.775L28.3687 54.8877L30.0306 56.0003C31.3453 54.0365 33.0365 52.3454 35.0003 51.0306L33.8877 49.3687ZM25.3807 62.0968L23.4187 61.7086C23.1438 63.0982 23 64.5333 23 66H25H27C27 64.7953 27.1181 63.6202 27.3427 62.4849L25.3807 62.0968ZM25 66H23V71H25H27V66H25ZM25 81H23V91H25H27V81H25ZM25 101H23V111H25H27V101H25ZM25 121H23V131H25H27V121H25ZM25 141H23V151H25H27V141H25ZM25 161H23V171H25H27V161H25ZM25 181H23V191H25H27V181H25ZM25 201H23V211H25H27V201H25ZM25 221H23V231H25H27V221H25ZM25 241H23V251H25H27V241H25ZM25 261H23V271H25H27V261H25ZM25 281H23V291H25H27V281H25ZM25 301H23V311H25H27V301H25ZM25 321H23V331H25H27V321H25ZM25 341H23V346H25H27V341H25ZM25 346H23C23 347.467 23.1438 348.902 23.4187 350.291L25.3807 349.903L27.3427 349.515C27.1181 348.38 27 347.205 27 346H25ZM28.3687 357.112L26.7068 358.225C28.3124 360.623 30.3768 362.688 32.775 364.293L33.8877 362.631L35.0003 360.969C33.0365 359.655 31.3454 357.963 30.0306 356L28.3687 357.112ZM41.0968 365.619L40.7086 367.581C42.0982 367.856 43.5333 368 45 368V366V364C43.7953 364 42.6202 363.882 41.4849 363.657L41.0968 365.619ZM45 366V368H49.8611V366V364H45V366ZM59.5833 366V368H69.3056V366V364H59.5833V366ZM79.0278 366V368H88.75V366V364H79.0278V366ZM98.4722 366V368H108.194V366V364H98.4722V366ZM117.917 366V368H127.639V366V364H117.917V366ZM137.361 366V368H147.083V366V364H137.361V366ZM156.806 366V368H166.528V366V364H156.806V366ZM176.25 366V368H185.972V366V364H176.25V366ZM195.694 366V368H205.417V366V364H195.694V366ZM215.139 366V368H224.861V366V364H215.139V366ZM234.583 366V368H244.306V366V364H234.583V366ZM254.028 366V368H263.75V366V364H254.028V366ZM273.472 366V368H283.195V366V364H273.472V366ZM292.917 366V368H302.639V366V364H292.917V366ZM312.361 366V368H322.083V366V364H312.361V366ZM331.806 366V368H341.528V366V364H331.806V366ZM351.25 366V368H360.972V366V364H351.25V366ZM370.695 366V368H380.417V366V364H370.695V366ZM390.139 366V368H395V366V364H390.139V366ZM395 366V368C397.301 368 399.501 367.542 401.508 366.709L400.742 364.862L399.976 363.014C398.446 363.649 396.766 364 395 364V366ZM408.862 356.742L410.709 357.508C411.542 355.501 412 353.301 412 351H410H408C408 352.766 407.649 354.446 407.014 355.976L408.862 356.742ZM410 351H412V347H410H408V351H410ZM410 339H412V331H410H408V339H410ZM410 323H412V319H410H408V323H410ZM410 319H412C412 317.234 412.351 315.554 412.986 314.024L411.138 313.258L409.291 312.492C408.458 314.499 408 316.699 408 319H410ZM419.258 305.138L420.024 306.986C421.554 306.351 423.234 306 425 306V304V302C422.699 302 420.499 302.458 418.492 303.291L419.258 305.138ZM425 304V306H429V304V302H425V304ZM437 304V306H445V304V302H437V304ZM453 304V306H457V304V302H453V304ZM457 304V306C459.301 306 461.501 305.542 463.508 304.709L462.742 302.862L461.976 301.014C460.446 301.649 458.766 302 457 302V304ZM470.862 294.742L472.709 295.508C473.542 293.501 474 291.301 474 289H472H470C470 290.766 469.649 292.446 469.014 293.976L470.862 294.742ZM472 289H474V283.932H472H470V289H472ZM472 273.795H474V263.659H472H470V273.795H472ZM472 253.523H474V243.386H472H470V253.523H472ZM472 233.25H474V223.114H472H470V233.25H472ZM472 212.977H474V202.841H472H470V212.977H472ZM472 192.705H474V182.568H472H470V192.705H472ZM472 172.432H474V162.295H472H470V172.432H472ZM472 152.159H474V142.023H472H470V152.159H472ZM472 131.886H474V121.75H472H470V131.886H472ZM472 111.614H474V101.477H472H470V111.614H472ZM472 91.3408H474V81.2045H472H470V91.3408H472ZM472 71.0681H474V66H472H470V71.0681H472Z"
											fill="#7B7B7B"
											mask="url(#path-1-inside-1_3456_24671)"
										/>
									</g>
									<defs>
										<filter
											id="filter0_ddd_3456_24671"
											x="-6"
											y="0"
											width="1082"
											height="911"
											filterUnits="userSpaceOnUse"
											color-interpolation-filters="sRGB"
										>
											<feFlood flood-opacity="0" result="BackgroundImageFix" />
											<feColorMatrix
												in="SourceAlpha"
												type="matrix"
												values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
												result="hardAlpha"
											/>
											<feOffset dx="99" dy="84" />
											<feGaussianBlur stdDeviation="65" />
											<feColorMatrix
												type="matrix"
												values="0 0 0 0 0.588235 0 0 0 0 0.588235 0 0 0 0 0.588235 0 0 0 0.09 0"
											/>
											<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_3456_24671" />
											<feColorMatrix
												in="SourceAlpha"
												type="matrix"
												values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
												result="hardAlpha"
											/>
											<feOffset dx="223" dy="189" />
											<feGaussianBlur stdDeviation="87.5" />
											<feColorMatrix
												type="matrix"
												values="0 0 0 0 0.588235 0 0 0 0 0.588235 0 0 0 0 0.588235 0 0 0 0.05 0"
											/>
											<feBlend
												mode="normal"
												in2="effect1_dropShadow_3456_24671"
												result="effect2_dropShadow_3456_24671"
											/>
											<feColorMatrix
												in="SourceAlpha"
												type="matrix"
												values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
												result="hardAlpha"
											/>
											<feOffset dx="396" dy="337" />
											<feGaussianBlur stdDeviation="104" />
											<feColorMatrix
												type="matrix"
												values="0 0 0 0 0.588235 0 0 0 0 0.588235 0 0 0 0 0.588235 0 0 0 0.01 0"
											/>
											<feBlend
												mode="normal"
												in2="effect2_dropShadow_3456_24671"
												result="effect3_dropShadow_3456_24671"
											/>
											<feBlend mode="normal" in="SourceGraphic" in2="effect3_dropShadow_3456_24671" result="shape" />
										</filter>
									</defs>
								</svg>
								<!-- Кнопка добавления -->
								<div class="portfolio-item portfolio-item--add" id="portfolioAddBtn">
									<div class="portfolio-item__plus">
										<input
											type="file"
											name="portfolio[]"
											id="portfolioInput"
											accept="image/jpeg,image/png,image/webp"
											multiple
											class="portfolio-item__input"
										/>
										<svg
											class="plus-svg"
											width="16"
											height="16"
											viewBox="0 0 16 16"
											fill="#fff"
											xmlns="http://www.w3.org/2000/svg"
										>
											<path
												d="M8.4 0C8.61217 0 8.81566 0.0842856 8.96569 0.234315C9.11572 0.384344 9.2 0.587827 9.2 0.8V6.8H15.2C15.4122 6.8 15.6157 6.88429 15.7657 7.03431C15.9157 7.18434 16 7.38783 16 7.6V8.4C16 8.61217 15.9157 8.81566 15.7657 8.96569C15.6157 9.11572 15.4122 9.2 15.2 9.2H9.2V15.2C9.2 15.4122 9.11572 15.6157 8.96569 15.7657C8.81566 15.9157 8.61217 16 8.4 16H7.6C7.38783 16 7.18434 15.9157 7.03431 15.7657C6.88429 15.6157 6.8 15.4122 6.8 15.2V9.2H0.8C0.587827 9.2 0.384344 9.11572 0.234315 8.96569C0.0842856 8.81566 0 8.61217 0 8.4V7.6C0 7.38783 0.0842856 7.18434 0.234315 7.03431C0.384344 6.88429 0.587827 6.8 0.8 6.8H6.8V0.8C6.8 0.587827 6.88429 0.384344 7.03431 0.234315C7.18434 0.0842856 7.38783 0 7.6 0H8.4Z"
											/>
										</svg>
									</div>
								</div>
							</div>

							<div class="portfolio-grid-2" id="portfolioGrid">
								<svg
									class="portfolio-sub__2"
									width="475"
									height="384"
									viewBox="0 0 475 384"
									fill="none"
									xmlns="http://www.w3.org/2000/svg"
								>
									<g filter="url(#filter0_ddd_3456_24671)">
										<mask id="path-1-inside-1_3456_24671" fill="#fff">
											<path
												fill-rule="evenodd"
												clip-rule="evenodd"
												d="M452 46C463.046 46 472 54.9543 472 66V289C472 297.284 465.284 304 457 304H425C416.716 304 410 310.716 410 319V351C410 359.284 403.284 366 395 366H45C33.9543 366 25 357.046 25 346V66C25 54.9543 33.9543 46 45 46H452Z"
											/>
										</mask>
										<path
											d="M472 66H473C473 64.5988 472.863 63.2287 472.6 61.9027L471.619 62.0968L470.638 62.2908C470.875 63.4897 471 64.7298 471 66H472ZM468.631 54.8877L469.462 54.3314C467.929 52.0417 465.958 50.0706 463.669 48.5377L463.112 49.3687L462.556 50.1997C464.628 51.5871 466.413 53.3716 467.8 55.444L468.631 54.8877ZM455.903 46.3807L456.097 45.3997C454.771 45.1374 453.401 45 452 45V46V47C453.27 47 454.51 47.1245 455.709 47.3617L455.903 46.3807ZM452 46V45H446.913V46V47H452V46ZM436.737 46V45H426.562V46V47H436.737V46ZM416.388 46V45H406.212V46V47H416.388V46ZM396.038 46V45H385.862V46V47H396.038V46ZM375.688 46V45H365.512V46V47H375.688V46ZM355.337 46V45H345.162V46V47H355.337V46ZM334.987 46V45H324.812V46V47H334.987V46ZM314.637 46V45H304.462V46V47H314.637V46ZM294.287 46V45H284.112V46V47H294.287V46ZM273.937 46V45H263.762V46V47H273.937V46ZM253.587 46V45H243.412V46V47H253.587V46ZM233.237 46V45H223.062V46V47H233.237V46ZM212.887 46V45H202.712V46V47H212.887V46ZM192.537 46V45H182.362V46V47H192.537V46ZM172.187 46V45H162.012V46V47H172.187V46ZM151.837 46V45H141.662V46V47H151.837V46ZM131.488 46V45H121.313V46V47H131.488V46ZM111.138 46V45H100.963V46V47H111.138V46ZM90.7876 46V45H80.6126V46V47H90.7876V46ZM70.4376 46V45H60.2626V46V47H70.4376V46ZM50.0876 46V45H45V46V47H50.0876V46ZM45 46V45C43.5988 45 42.2287 45.1374 40.9027 45.3997L41.0967 46.3807L41.2908 47.3617C42.4897 47.1245 43.7298 47 45 47V46ZM33.8877 49.3687L33.3314 48.5377C31.0417 50.0706 29.0706 52.0417 27.5377 54.3314L28.3687 54.8877L29.1997 55.444C30.5871 53.3716 32.3716 51.5871 34.444 50.1997L33.8877 49.3687ZM25.3807 62.0968L24.3997 61.9027C24.1374 63.2287 24 64.5988 24 66H25H26C26 64.7298 26.1245 63.4897 26.3617 62.2908L25.3807 62.0968ZM25 66H24V71H25H26V66H25ZM25 81H24V91H25H26V81H25ZM25 101H24V111H25H26V101H25ZM25 121H24V131H25H26V121H25ZM25 141H24V151H25H26V141H25ZM25 161H24V171H25H26V161H25ZM25 181H24V191H25H26V181H25ZM25 201H24V211H25H26V201H25ZM25 221H24V231H25H26V221H25ZM25 241H24V251H25H26V241H25ZM25 261H24V271H25H26V261H25ZM25 281H24V291H25H26V281H25ZM25 301H24V311H25H26V301H25ZM25 321H24V331H25H26V321H25ZM25 341H24V346H25H26V341H25ZM25 346H24C24 347.401 24.1374 348.771 24.3997 350.097L25.3807 349.903L26.3617 349.709C26.1245 348.51 26 347.27 26 346H25ZM28.3687 357.112L27.5377 357.669C29.0706 359.958 31.0417 361.929 33.3314 363.462L33.8877 362.631L34.444 361.8C32.3716 360.413 30.5871 358.628 29.1997 356.556L28.3687 357.112ZM41.0968 365.619L40.9027 366.6C42.2287 366.863 43.5988 367 45 367V366V365C43.7298 365 42.4897 364.875 41.2908 364.638L41.0968 365.619ZM45 366V367H49.8611V366V365H45V366ZM59.5833 366V367H69.3056V366V365H59.5833V366ZM79.0278 366V367H88.75V366V365H79.0278V366ZM98.4722 366V367H108.194V366V365H98.4722V366ZM117.917 366V367H127.639V366V365H117.917V366ZM137.361 366V367H147.083V366V365H137.361V366ZM156.806 366V367H166.528V366V365H156.806V366ZM176.25 366V367H185.972V366V365H176.25V366ZM195.694 366V367H205.417V366V365H195.694V366ZM215.139 366V367H224.861V366V365H215.139V366ZM234.583 366V367H244.306V366V365H234.583V366ZM254.028 366V367H263.75V366V365H254.028V366ZM273.472 366V367H283.195V366V365H273.472V366ZM292.917 366V367H302.639V366V365H292.917V366ZM312.361 366V367H322.083V366V365H312.361V366ZM331.806 366V367H341.528V366V365H331.806V366ZM351.25 366V367H360.972V366V365H351.25V366ZM370.695 366V367H380.417V366V365H370.695V366ZM390.139 366V367H395V366V365H390.139V366ZM395 366V367C397.168 367 399.237 366.568 401.125 365.786L400.742 364.862L400.359 363.938C398.709 364.622 396.9 365 395 365V366ZM408.862 356.742L409.786 357.125C410.568 355.237 411 353.168 411 351H410H409C409 352.9 408.622 354.709 407.938 356.359L408.862 356.742ZM410 351H411V347H410H409V351H410ZM410 339H411V331H410H409V339H410ZM410 323H411V319H410H409V323H410ZM410 319H411C411 317.1 411.378 315.291 412.062 313.641L411.138 313.258L410.214 312.875C409.432 314.763 409 316.832 409 319H410ZM419.258 305.138L419.641 306.062C421.291 305.378 423.1 305 425 305V304V303C422.832 303 420.763 303.432 418.875 304.214L419.258 305.138ZM425 304V305H429V304V303H425V304ZM437 304V305H445V304V303H437V304ZM453 304V305H457V304V303H453V304ZM457 304V305C459.168 305 461.237 304.568 463.125 303.786L462.742 302.862L462.359 301.938C460.709 302.622 458.9 303 457 303V304ZM470.862 294.742L471.786 295.125C472.568 293.237 473 291.168 473 289H472H471C471 290.9 470.622 292.709 469.938 294.359L470.862 294.742ZM472 289H473V283.932H472H471V289H472ZM472 273.795H473V263.659H472H471V273.795H472ZM472 253.523H473V243.386H472H471V253.523H472ZM472 233.25H473V223.114H472H471V233.25H472ZM472 212.977H473V202.841H472H471V212.977H472ZM472 192.705H473V182.568H472H471V192.705H472ZM472 172.432H473V162.295H472H471V172.432H472ZM472 152.159H473V142.023H472H471V152.159H472ZM472 131.886H473V121.75H472H471V131.886H472ZM472 111.614H473V101.477H472H471V111.614H472ZM472 91.3408H473V81.2045H472H471V91.3408H472ZM472 71.0681H473V66H472H471V71.0681H472ZM472 66H474C474 64.5333 473.856 63.0982 473.581 61.7086L471.619 62.0968L469.657 62.4849C469.882 63.6202 470 64.7953 470 66H472ZM468.631 54.8877L470.293 53.775C468.688 51.3768 466.623 49.3124 464.225 47.7068L463.112 49.3687L462 51.0306C463.963 52.3454 465.655 54.0365 466.969 56.0003L468.631 54.8877ZM455.903 46.3807L456.291 44.4187C454.902 44.1438 453.467 44 452 44V46V48C453.205 48 454.38 48.1181 455.515 48.3427L455.903 46.3807ZM452 46V44H446.913V46V48H452V46ZM436.737 46V44H426.562V46V48H436.737V46ZM416.388 46V44H406.212V46V48H416.388V46ZM396.038 46V44H385.862V46V48H396.038V46ZM375.688 46V44H365.512V46V48H375.688V46ZM355.337 46V44H345.162V46V48H355.337V46ZM334.987 46V44H324.812V46V48H334.987V46ZM314.637 46V44H304.462V46V48H314.637V46ZM294.287 46V44H284.112V46V48H294.287V46ZM273.937 46V44H263.762V46V48H273.937V46ZM253.587 46V44H243.412V46V48H253.587V46ZM233.237 46V44H223.062V46V48H233.237V46ZM212.887 46V44H202.712V46V48H212.887V46ZM192.537 46V44H182.362V46V48H192.537V46ZM172.187 46V44H162.012V46V48H172.187V46ZM151.837 46V44H141.662V46V48H151.837V46ZM131.488 46V44H121.313V46V48H131.488V46ZM111.138 46V44H100.963V46V48H111.138V46ZM90.7876 46V44H80.6126V46V48H90.7876V46ZM70.4376 46V44H60.2626V46V48H70.4376V46ZM50.0876 46V44H45V46V48H50.0876V46ZM45 46V44C43.5333 44 42.0982 44.1438 40.7086 44.4187L41.0967 46.3807L41.4849 48.3427C42.6202 48.1181 43.7953 48 45 48V46ZM33.8877 49.3687L32.775 47.7068C30.3768 49.3124 28.3123 51.3768 26.7068 53.775L28.3687 54.8877L30.0306 56.0003C31.3453 54.0365 33.0365 52.3454 35.0003 51.0306L33.8877 49.3687ZM25.3807 62.0968L23.4187 61.7086C23.1438 63.0982 23 64.5333 23 66H25H27C27 64.7953 27.1181 63.6202 27.3427 62.4849L25.3807 62.0968ZM25 66H23V71H25H27V66H25ZM25 81H23V91H25H27V81H25ZM25 101H23V111H25H27V101H25ZM25 121H23V131H25H27V121H25ZM25 141H23V151H25H27V141H25ZM25 161H23V171H25H27V161H25ZM25 181H23V191H25H27V181H25ZM25 201H23V211H25H27V201H25ZM25 221H23V231H25H27V221H25ZM25 241H23V251H25H27V241H25ZM25 261H23V271H25H27V261H25ZM25 281H23V291H25H27V281H25ZM25 301H23V311H25H27V301H25ZM25 321H23V331H25H27V321H25ZM25 341H23V346H25H27V341H25ZM25 346H23C23 347.467 23.1438 348.902 23.4187 350.291L25.3807 349.903L27.3427 349.515C27.1181 348.38 27 347.205 27 346H25ZM28.3687 357.112L26.7068 358.225C28.3124 360.623 30.3768 362.688 32.775 364.293L33.8877 362.631L35.0003 360.969C33.0365 359.655 31.3454 357.963 30.0306 356L28.3687 357.112ZM41.0968 365.619L40.7086 367.581C42.0982 367.856 43.5333 368 45 368V366V364C43.7953 364 42.6202 363.882 41.4849 363.657L41.0968 365.619ZM45 366V368H49.8611V366V364H45V366ZM59.5833 366V368H69.3056V366V364H59.5833V366ZM79.0278 366V368H88.75V366V364H79.0278V366ZM98.4722 366V368H108.194V366V364H98.4722V366ZM117.917 366V368H127.639V366V364H117.917V366ZM137.361 366V368H147.083V366V364H137.361V366ZM156.806 366V368H166.528V366V364H156.806V366ZM176.25 366V368H185.972V366V364H176.25V366ZM195.694 366V368H205.417V366V364H195.694V366ZM215.139 366V368H224.861V366V364H215.139V366ZM234.583 366V368H244.306V366V364H234.583V366ZM254.028 366V368H263.75V366V364H254.028V366ZM273.472 366V368H283.195V366V364H273.472V366ZM292.917 366V368H302.639V366V364H292.917V366ZM312.361 366V368H322.083V366V364H312.361V366ZM331.806 366V368H341.528V366V364H331.806V366ZM351.25 366V368H360.972V366V364H351.25V366ZM370.695 366V368H380.417V366V364H370.695V366ZM390.139 366V368H395V366V364H390.139V366ZM395 366V368C397.301 368 399.501 367.542 401.508 366.709L400.742 364.862L399.976 363.014C398.446 363.649 396.766 364 395 364V366ZM408.862 356.742L410.709 357.508C411.542 355.501 412 353.301 412 351H410H408C408 352.766 407.649 354.446 407.014 355.976L408.862 356.742ZM410 351H412V347H410H408V351H410ZM410 339H412V331H410H408V339H410ZM410 323H412V319H410H408V323H410ZM410 319H412C412 317.234 412.351 315.554 412.986 314.024L411.138 313.258L409.291 312.492C408.458 314.499 408 316.699 408 319H410ZM419.258 305.138L420.024 306.986C421.554 306.351 423.234 306 425 306V304V302C422.699 302 420.499 302.458 418.492 303.291L419.258 305.138ZM425 304V306H429V304V302H425V304ZM437 304V306H445V304V302H437V304ZM453 304V306H457V304V302H453V304ZM457 304V306C459.301 306 461.501 305.542 463.508 304.709L462.742 302.862L461.976 301.014C460.446 301.649 458.766 302 457 302V304ZM470.862 294.742L472.709 295.508C473.542 293.501 474 291.301 474 289H472H470C470 290.766 469.649 292.446 469.014 293.976L470.862 294.742ZM472 289H474V283.932H472H470V289H472ZM472 273.795H474V263.659H472H470V273.795H472ZM472 253.523H474V243.386H472H470V253.523H472ZM472 233.25H474V223.114H472H470V233.25H472ZM472 212.977H474V202.841H472H470V212.977H472ZM472 192.705H474V182.568H472H470V192.705H472ZM472 172.432H474V162.295H472H470V172.432H472ZM472 152.159H474V142.023H472H470V152.159H472ZM472 131.886H474V121.75H472H470V131.886H472ZM472 111.614H474V101.477H472H470V111.614H472ZM472 91.3408H474V81.2045H472H470V91.3408H472ZM472 71.0681H474V66H472H470V71.0681H472Z"
											fill="#7B7B7B"
											mask="url(#path-1-inside-1_3456_24671)"
										/>
									</g>
									<defs>
										<filter
											id="filter0_ddd_3456_24671"
											x="-6"
											y="0"
											width="1082"
											height="911"
											filterUnits="userSpaceOnUse"
											color-interpolation-filters="sRGB"
										>
											<feFlood flood-opacity="0" result="BackgroundImageFix" />
											<feColorMatrix
												in="SourceAlpha"
												type="matrix"
												values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
												result="hardAlpha"
											/>
											<feOffset dx="99" dy="84" />
											<feGaussianBlur stdDeviation="65" />
											<feColorMatrix
												type="matrix"
												values="0 0 0 0 0.588235 0 0 0 0 0.588235 0 0 0 0 0.588235 0 0 0 0.09 0"
											/>
											<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_3456_24671" />
											<feColorMatrix
												in="SourceAlpha"
												type="matrix"
												values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
												result="hardAlpha"
											/>
											<feOffset dx="223" dy="189" />
											<feGaussianBlur stdDeviation="87.5" />
											<feColorMatrix
												type="matrix"
												values="0 0 0 0 0.588235 0 0 0 0 0.588235 0 0 0 0 0.588235 0 0 0 0.05 0"
											/>
											<feBlend
												mode="normal"
												in2="effect1_dropShadow_3456_24671"
												result="effect2_dropShadow_3456_24671"
											/>
											<feColorMatrix
												in="SourceAlpha"
												type="matrix"
												values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
												result="hardAlpha"
											/>
											<feOffset dx="396" dy="337" />
											<feGaussianBlur stdDeviation="104" />
											<feColorMatrix
												type="matrix"
												values="0 0 0 0 0.588235 0 0 0 0 0.588235 0 0 0 0 0.588235 0 0 0 0.01 0"
											/>
											<feBlend
												mode="normal"
												in2="effect2_dropShadow_3456_24671"
												result="effect3_dropShadow_3456_24671"
											/>
											<feBlend mode="normal" in="SourceGraphic" in2="effect3_dropShadow_3456_24671" result="shape" />
										</filter>
									</defs>
								</svg>
								<!-- Кнопка добавления -->
								<div class="portfolio-item portfolio-item--add" id="portfolioAddBtn">
									<div class="portfolio-item__plus-2">
										<input
											type="file"
											name="portfolio[]"
											id="portfolioInput"
											accept="image/jpeg,image/png,image/webp"
											multiple
											class="portfolio-item__input"
										/>
										<svg
											class="plus-svg"
											width="16"
											height="16"
											viewBox="0 0 16 16"
											fill="#fff"
											xmlns="http://www.w3.org/2000/svg"
										>
											<path
												d="M8.4 0C8.61217 0 8.81566 0.0842856 8.96569 0.234315C9.11572 0.384344 9.2 0.587827 9.2 0.8V6.8H15.2C15.4122 6.8 15.6157 6.88429 15.7657 7.03431C15.9157 7.18434 16 7.38783 16 7.6V8.4C16 8.61217 15.9157 8.81566 15.7657 8.96569C15.6157 9.11572 15.4122 9.2 15.2 9.2H9.2V15.2C9.2 15.4122 9.11572 15.6157 8.96569 15.7657C8.81566 15.9157 8.61217 16 8.4 16H7.6C7.38783 16 7.18434 15.9157 7.03431 15.7657C6.88429 15.6157 6.8 15.4122 6.8 15.2V9.2H0.8C0.587827 9.2 0.384344 9.11572 0.234315 8.96569C0.0842856 8.81566 0 8.61217 0 8.4V7.6C0 7.38783 0.0842856 7.18434 0.234315 7.03431C0.384344 6.88429 0.587827 6.8 0.8 6.8H6.8V0.8C6.8 0.587827 6.88429 0.384344 7.03431 0.234315C7.18434 0.0842856 7.38783 0 7.6 0H8.4Z"
											/>
										</svg>
									</div>
								</div>
							</div>

							<div class="portfolio-grid-3" id="portfolioGrid">
								<svg
									class="portfolio-sub__3"
									width="475"
									height="384"
									viewBox="0 0 475 384"
									fill="none"
									xmlns="http://www.w3.org/2000/svg"
								>
									<g filter="url(#filter0_ddd_3456_24671)">
										<mask id="path-1-inside-1_3456_24671" fill="#fff">
											<path
												fill-rule="evenodd"
												clip-rule="evenodd"
												d="M452 46C463.046 46 472 54.9543 472 66V289C472 297.284 465.284 304 457 304H425C416.716 304 410 310.716 410 319V351C410 359.284 403.284 366 395 366H45C33.9543 366 25 357.046 25 346V66C25 54.9543 33.9543 46 45 46H452Z"
											/>
										</mask>
										<path
											d="M472 66H473C473 64.5988 472.863 63.2287 472.6 61.9027L471.619 62.0968L470.638 62.2908C470.875 63.4897 471 64.7298 471 66H472ZM468.631 54.8877L469.462 54.3314C467.929 52.0417 465.958 50.0706 463.669 48.5377L463.112 49.3687L462.556 50.1997C464.628 51.5871 466.413 53.3716 467.8 55.444L468.631 54.8877ZM455.903 46.3807L456.097 45.3997C454.771 45.1374 453.401 45 452 45V46V47C453.27 47 454.51 47.1245 455.709 47.3617L455.903 46.3807ZM452 46V45H446.913V46V47H452V46ZM436.737 46V45H426.562V46V47H436.737V46ZM416.388 46V45H406.212V46V47H416.388V46ZM396.038 46V45H385.862V46V47H396.038V46ZM375.688 46V45H365.512V46V47H375.688V46ZM355.337 46V45H345.162V46V47H355.337V46ZM334.987 46V45H324.812V46V47H334.987V46ZM314.637 46V45H304.462V46V47H314.637V46ZM294.287 46V45H284.112V46V47H294.287V46ZM273.937 46V45H263.762V46V47H273.937V46ZM253.587 46V45H243.412V46V47H253.587V46ZM233.237 46V45H223.062V46V47H233.237V46ZM212.887 46V45H202.712V46V47H212.887V46ZM192.537 46V45H182.362V46V47H192.537V46ZM172.187 46V45H162.012V46V47H172.187V46ZM151.837 46V45H141.662V46V47H151.837V46ZM131.488 46V45H121.313V46V47H131.488V46ZM111.138 46V45H100.963V46V47H111.138V46ZM90.7876 46V45H80.6126V46V47H90.7876V46ZM70.4376 46V45H60.2626V46V47H70.4376V46ZM50.0876 46V45H45V46V47H50.0876V46ZM45 46V45C43.5988 45 42.2287 45.1374 40.9027 45.3997L41.0967 46.3807L41.2908 47.3617C42.4897 47.1245 43.7298 47 45 47V46ZM33.8877 49.3687L33.3314 48.5377C31.0417 50.0706 29.0706 52.0417 27.5377 54.3314L28.3687 54.8877L29.1997 55.444C30.5871 53.3716 32.3716 51.5871 34.444 50.1997L33.8877 49.3687ZM25.3807 62.0968L24.3997 61.9027C24.1374 63.2287 24 64.5988 24 66H25H26C26 64.7298 26.1245 63.4897 26.3617 62.2908L25.3807 62.0968ZM25 66H24V71H25H26V66H25ZM25 81H24V91H25H26V81H25ZM25 101H24V111H25H26V101H25ZM25 121H24V131H25H26V121H25ZM25 141H24V151H25H26V141H25ZM25 161H24V171H25H26V161H25ZM25 181H24V191H25H26V181H25ZM25 201H24V211H25H26V201H25ZM25 221H24V231H25H26V221H25ZM25 241H24V251H25H26V241H25ZM25 261H24V271H25H26V261H25ZM25 281H24V291H25H26V281H25ZM25 301H24V311H25H26V301H25ZM25 321H24V331H25H26V321H25ZM25 341H24V346H25H26V341H25ZM25 346H24C24 347.401 24.1374 348.771 24.3997 350.097L25.3807 349.903L26.3617 349.709C26.1245 348.51 26 347.27 26 346H25ZM28.3687 357.112L27.5377 357.669C29.0706 359.958 31.0417 361.929 33.3314 363.462L33.8877 362.631L34.444 361.8C32.3716 360.413 30.5871 358.628 29.1997 356.556L28.3687 357.112ZM41.0968 365.619L40.9027 366.6C42.2287 366.863 43.5988 367 45 367V366V365C43.7298 365 42.4897 364.875 41.2908 364.638L41.0968 365.619ZM45 366V367H49.8611V366V365H45V366ZM59.5833 366V367H69.3056V366V365H59.5833V366ZM79.0278 366V367H88.75V366V365H79.0278V366ZM98.4722 366V367H108.194V366V365H98.4722V366ZM117.917 366V367H127.639V366V365H117.917V366ZM137.361 366V367H147.083V366V365H137.361V366ZM156.806 366V367H166.528V366V365H156.806V366ZM176.25 366V367H185.972V366V365H176.25V366ZM195.694 366V367H205.417V366V365H195.694V366ZM215.139 366V367H224.861V366V365H215.139V366ZM234.583 366V367H244.306V366V365H234.583V366ZM254.028 366V367H263.75V366V365H254.028V366ZM273.472 366V367H283.195V366V365H273.472V366ZM292.917 366V367H302.639V366V365H292.917V366ZM312.361 366V367H322.083V366V365H312.361V366ZM331.806 366V367H341.528V366V365H331.806V366ZM351.25 366V367H360.972V366V365H351.25V366ZM370.695 366V367H380.417V366V365H370.695V366ZM390.139 366V367H395V366V365H390.139V366ZM395 366V367C397.168 367 399.237 366.568 401.125 365.786L400.742 364.862L400.359 363.938C398.709 364.622 396.9 365 395 365V366ZM408.862 356.742L409.786 357.125C410.568 355.237 411 353.168 411 351H410H409C409 352.9 408.622 354.709 407.938 356.359L408.862 356.742ZM410 351H411V347H410H409V351H410ZM410 339H411V331H410H409V339H410ZM410 323H411V319H410H409V323H410ZM410 319H411C411 317.1 411.378 315.291 412.062 313.641L411.138 313.258L410.214 312.875C409.432 314.763 409 316.832 409 319H410ZM419.258 305.138L419.641 306.062C421.291 305.378 423.1 305 425 305V304V303C422.832 303 420.763 303.432 418.875 304.214L419.258 305.138ZM425 304V305H429V304V303H425V304ZM437 304V305H445V304V303H437V304ZM453 304V305H457V304V303H453V304ZM457 304V305C459.168 305 461.237 304.568 463.125 303.786L462.742 302.862L462.359 301.938C460.709 302.622 458.9 303 457 303V304ZM470.862 294.742L471.786 295.125C472.568 293.237 473 291.168 473 289H472H471C471 290.9 470.622 292.709 469.938 294.359L470.862 294.742ZM472 289H473V283.932H472H471V289H472ZM472 273.795H473V263.659H472H471V273.795H472ZM472 253.523H473V243.386H472H471V253.523H472ZM472 233.25H473V223.114H472H471V233.25H472ZM472 212.977H473V202.841H472H471V212.977H472ZM472 192.705H473V182.568H472H471V192.705H472ZM472 172.432H473V162.295H472H471V172.432H472ZM472 152.159H473V142.023H472H471V152.159H472ZM472 131.886H473V121.75H472H471V131.886H472ZM472 111.614H473V101.477H472H471V111.614H472ZM472 91.3408H473V81.2045H472H471V91.3408H472ZM472 71.0681H473V66H472H471V71.0681H472ZM472 66H474C474 64.5333 473.856 63.0982 473.581 61.7086L471.619 62.0968L469.657 62.4849C469.882 63.6202 470 64.7953 470 66H472ZM468.631 54.8877L470.293 53.775C468.688 51.3768 466.623 49.3124 464.225 47.7068L463.112 49.3687L462 51.0306C463.963 52.3454 465.655 54.0365 466.969 56.0003L468.631 54.8877ZM455.903 46.3807L456.291 44.4187C454.902 44.1438 453.467 44 452 44V46V48C453.205 48 454.38 48.1181 455.515 48.3427L455.903 46.3807ZM452 46V44H446.913V46V48H452V46ZM436.737 46V44H426.562V46V48H436.737V46ZM416.388 46V44H406.212V46V48H416.388V46ZM396.038 46V44H385.862V46V48H396.038V46ZM375.688 46V44H365.512V46V48H375.688V46ZM355.337 46V44H345.162V46V48H355.337V46ZM334.987 46V44H324.812V46V48H334.987V46ZM314.637 46V44H304.462V46V48H314.637V46ZM294.287 46V44H284.112V46V48H294.287V46ZM273.937 46V44H263.762V46V48H273.937V46ZM253.587 46V44H243.412V46V48H253.587V46ZM233.237 46V44H223.062V46V48H233.237V46ZM212.887 46V44H202.712V46V48H212.887V46ZM192.537 46V44H182.362V46V48H192.537V46ZM172.187 46V44H162.012V46V48H172.187V46ZM151.837 46V44H141.662V46V48H151.837V46ZM131.488 46V44H121.313V46V48H131.488V46ZM111.138 46V44H100.963V46V48H111.138V46ZM90.7876 46V44H80.6126V46V48H90.7876V46ZM70.4376 46V44H60.2626V46V48H70.4376V46ZM50.0876 46V44H45V46V48H50.0876V46ZM45 46V44C43.5333 44 42.0982 44.1438 40.7086 44.4187L41.0967 46.3807L41.4849 48.3427C42.6202 48.1181 43.7953 48 45 48V46ZM33.8877 49.3687L32.775 47.7068C30.3768 49.3124 28.3123 51.3768 26.7068 53.775L28.3687 54.8877L30.0306 56.0003C31.3453 54.0365 33.0365 52.3454 35.0003 51.0306L33.8877 49.3687ZM25.3807 62.0968L23.4187 61.7086C23.1438 63.0982 23 64.5333 23 66H25H27C27 64.7953 27.1181 63.6202 27.3427 62.4849L25.3807 62.0968ZM25 66H23V71H25H27V66H25ZM25 81H23V91H25H27V81H25ZM25 101H23V111H25H27V101H25ZM25 121H23V131H25H27V121H25ZM25 141H23V151H25H27V141H25ZM25 161H23V171H25H27V161H25ZM25 181H23V191H25H27V181H25ZM25 201H23V211H25H27V201H25ZM25 221H23V231H25H27V221H25ZM25 241H23V251H25H27V241H25ZM25 261H23V271H25H27V261H25ZM25 281H23V291H25H27V281H25ZM25 301H23V311H25H27V301H25ZM25 321H23V331H25H27V321H25ZM25 341H23V346H25H27V341H25ZM25 346H23C23 347.467 23.1438 348.902 23.4187 350.291L25.3807 349.903L27.3427 349.515C27.1181 348.38 27 347.205 27 346H25ZM28.3687 357.112L26.7068 358.225C28.3124 360.623 30.3768 362.688 32.775 364.293L33.8877 362.631L35.0003 360.969C33.0365 359.655 31.3454 357.963 30.0306 356L28.3687 357.112ZM41.0968 365.619L40.7086 367.581C42.0982 367.856 43.5333 368 45 368V366V364C43.7953 364 42.6202 363.882 41.4849 363.657L41.0968 365.619ZM45 366V368H49.8611V366V364H45V366ZM59.5833 366V368H69.3056V366V364H59.5833V366ZM79.0278 366V368H88.75V366V364H79.0278V366ZM98.4722 366V368H108.194V366V364H98.4722V366ZM117.917 366V368H127.639V366V364H117.917V366ZM137.361 366V368H147.083V366V364H137.361V366ZM156.806 366V368H166.528V366V364H156.806V366ZM176.25 366V368H185.972V366V364H176.25V366ZM195.694 366V368H205.417V366V364H195.694V366ZM215.139 366V368H224.861V366V364H215.139V366ZM234.583 366V368H244.306V366V364H234.583V366ZM254.028 366V368H263.75V366V364H254.028V366ZM273.472 366V368H283.195V366V364H273.472V366ZM292.917 366V368H302.639V366V364H292.917V366ZM312.361 366V368H322.083V366V364H312.361V366ZM331.806 366V368H341.528V366V364H331.806V366ZM351.25 366V368H360.972V366V364H351.25V366ZM370.695 366V368H380.417V366V364H370.695V366ZM390.139 366V368H395V366V364H390.139V366ZM395 366V368C397.301 368 399.501 367.542 401.508 366.709L400.742 364.862L399.976 363.014C398.446 363.649 396.766 364 395 364V366ZM408.862 356.742L410.709 357.508C411.542 355.501 412 353.301 412 351H410H408C408 352.766 407.649 354.446 407.014 355.976L408.862 356.742ZM410 351H412V347H410H408V351H410ZM410 339H412V331H410H408V339H410ZM410 323H412V319H410H408V323H410ZM410 319H412C412 317.234 412.351 315.554 412.986 314.024L411.138 313.258L409.291 312.492C408.458 314.499 408 316.699 408 319H410ZM419.258 305.138L420.024 306.986C421.554 306.351 423.234 306 425 306V304V302C422.699 302 420.499 302.458 418.492 303.291L419.258 305.138ZM425 304V306H429V304V302H425V304ZM437 304V306H445V304V302H437V304ZM453 304V306H457V304V302H453V304ZM457 304V306C459.301 306 461.501 305.542 463.508 304.709L462.742 302.862L461.976 301.014C460.446 301.649 458.766 302 457 302V304ZM470.862 294.742L472.709 295.508C473.542 293.501 474 291.301 474 289H472H470C470 290.766 469.649 292.446 469.014 293.976L470.862 294.742ZM472 289H474V283.932H472H470V289H472ZM472 273.795H474V263.659H472H470V273.795H472ZM472 253.523H474V243.386H472H470V253.523H472ZM472 233.25H474V223.114H472H470V233.25H472ZM472 212.977H474V202.841H472H470V212.977H472ZM472 192.705H474V182.568H472H470V192.705H472ZM472 172.432H474V162.295H472H470V172.432H472ZM472 152.159H474V142.023H472H470V152.159H472ZM472 131.886H474V121.75H472H470V131.886H472ZM472 111.614H474V101.477H472H470V111.614H472ZM472 91.3408H474V81.2045H472H470V91.3408H472ZM472 71.0681H474V66H472H470V71.0681H472Z"
											fill="#7B7B7B"
											mask="url(#path-1-inside-1_3456_24671)"
										/>
									</g>
									<defs>
										<filter
											id="filter0_ddd_3456_24671"
											x="-6"
											y="0"
											width="1082"
											height="911"
											filterUnits="userSpaceOnUse"
											color-interpolation-filters="sRGB"
										>
											<feFlood flood-opacity="0" result="BackgroundImageFix" />
											<feColorMatrix
												in="SourceAlpha"
												type="matrix"
												values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
												result="hardAlpha"
											/>
											<feOffset dx="99" dy="84" />
											<feGaussianBlur stdDeviation="65" />
											<feColorMatrix
												type="matrix"
												values="0 0 0 0 0.588235 0 0 0 0 0.588235 0 0 0 0 0.588235 0 0 0 0.09 0"
											/>
											<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_3456_24671" />
											<feColorMatrix
												in="SourceAlpha"
												type="matrix"
												values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
												result="hardAlpha"
											/>
											<feOffset dx="223" dy="189" />
											<feGaussianBlur stdDeviation="87.5" />
											<feColorMatrix
												type="matrix"
												values="0 0 0 0 0.588235 0 0 0 0 0.588235 0 0 0 0 0.588235 0 0 0 0.05 0"
											/>
											<feBlend
												mode="normal"
												in2="effect1_dropShadow_3456_24671"
												result="effect2_dropShadow_3456_24671"
											/>
											<feColorMatrix
												in="SourceAlpha"
												type="matrix"
												values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
												result="hardAlpha"
											/>
											<feOffset dx="396" dy="337" />
											<feGaussianBlur stdDeviation="104" />
											<feColorMatrix
												type="matrix"
												values="0 0 0 0 0.588235 0 0 0 0 0.588235 0 0 0 0 0.588235 0 0 0 0.01 0"
											/>
											<feBlend
												mode="normal"
												in2="effect2_dropShadow_3456_24671"
												result="effect3_dropShadow_3456_24671"
											/>
											<feBlend mode="normal" in="SourceGraphic" in2="effect3_dropShadow_3456_24671" result="shape" />
										</filter>
									</defs>
								</svg>
								<!-- Кнопка добавления -->
								<div class="portfolio-item portfolio-item--add" id="portfolioAddBtn">
									<div class="portfolio-item__plus-3">
										<input
											type="file"
											name="portfolio[]"
											id="portfolioInput"
											accept="image/jpeg,image/png,image/webp"
											multiple
											class="portfolio-item__input"
										/>
										<svg
											class="plus-svg"
											width="16"
											height="16"
											viewBox="0 0 16 16"
											fill="#fff"
											xmlns="http://www.w3.org/2000/svg"
										>
											<path
												d="M8.4 0C8.61217 0 8.81566 0.0842856 8.96569 0.234315C9.11572 0.384344 9.2 0.587827 9.2 0.8V6.8H15.2C15.4122 6.8 15.6157 6.88429 15.7657 7.03431C15.9157 7.18434 16 7.38783 16 7.6V8.4C16 8.61217 15.9157 8.81566 15.7657 8.96569C15.6157 9.11572 15.4122 9.2 15.2 9.2H9.2V15.2C9.2 15.4122 9.11572 15.6157 8.96569 15.7657C8.81566 15.9157 8.61217 16 8.4 16H7.6C7.38783 16 7.18434 15.9157 7.03431 15.7657C6.88429 15.6157 6.8 15.4122 6.8 15.2V9.2H0.8C0.587827 9.2 0.384344 9.11572 0.234315 8.96569C0.0842856 8.81566 0 8.61217 0 8.4V7.6C0 7.38783 0.0842856 7.18434 0.234315 7.03431C0.384344 6.88429 0.587827 6.8 0.8 6.8H6.8V0.8C6.8 0.587827 6.88429 0.384344 7.03431 0.234315C7.18434 0.0842856 7.38783 0 7.6 0H8.4Z"
											/>
										</svg>
									</div>
								</div>
							</div>
							<div class="portfolio-grid-4" id="portfolioGrid">
								<svg
									class="portfolio-sub__4"
									width="475"
									height="384"
									viewBox="0 0 475 384"
									fill="none"
									xmlns="http://www.w3.org/2000/svg"
								>
									<g filter="url(#filter0_ddd_3456_24671)">
										<mask id="path-1-inside-1_3456_24671" fill="#fff">
											<path
												fill-rule="evenodd"
												clip-rule="evenodd"
												d="M452 46C463.046 46 472 54.9543 472 66V289C472 297.284 465.284 304 457 304H425C416.716 304 410 310.716 410 319V351C410 359.284 403.284 366 395 366H45C33.9543 366 25 357.046 25 346V66C25 54.9543 33.9543 46 45 46H452Z"
											/>
										</mask>
										<path
											d="M472 66H473C473 64.5988 472.863 63.2287 472.6 61.9027L471.619 62.0968L470.638 62.2908C470.875 63.4897 471 64.7298 471 66H472ZM468.631 54.8877L469.462 54.3314C467.929 52.0417 465.958 50.0706 463.669 48.5377L463.112 49.3687L462.556 50.1997C464.628 51.5871 466.413 53.3716 467.8 55.444L468.631 54.8877ZM455.903 46.3807L456.097 45.3997C454.771 45.1374 453.401 45 452 45V46V47C453.27 47 454.51 47.1245 455.709 47.3617L455.903 46.3807ZM452 46V45H446.913V46V47H452V46ZM436.737 46V45H426.562V46V47H436.737V46ZM416.388 46V45H406.212V46V47H416.388V46ZM396.038 46V45H385.862V46V47H396.038V46ZM375.688 46V45H365.512V46V47H375.688V46ZM355.337 46V45H345.162V46V47H355.337V46ZM334.987 46V45H324.812V46V47H334.987V46ZM314.637 46V45H304.462V46V47H314.637V46ZM294.287 46V45H284.112V46V47H294.287V46ZM273.937 46V45H263.762V46V47H273.937V46ZM253.587 46V45H243.412V46V47H253.587V46ZM233.237 46V45H223.062V46V47H233.237V46ZM212.887 46V45H202.712V46V47H212.887V46ZM192.537 46V45H182.362V46V47H192.537V46ZM172.187 46V45H162.012V46V47H172.187V46ZM151.837 46V45H141.662V46V47H151.837V46ZM131.488 46V45H121.313V46V47H131.488V46ZM111.138 46V45H100.963V46V47H111.138V46ZM90.7876 46V45H80.6126V46V47H90.7876V46ZM70.4376 46V45H60.2626V46V47H70.4376V46ZM50.0876 46V45H45V46V47H50.0876V46ZM45 46V45C43.5988 45 42.2287 45.1374 40.9027 45.3997L41.0967 46.3807L41.2908 47.3617C42.4897 47.1245 43.7298 47 45 47V46ZM33.8877 49.3687L33.3314 48.5377C31.0417 50.0706 29.0706 52.0417 27.5377 54.3314L28.3687 54.8877L29.1997 55.444C30.5871 53.3716 32.3716 51.5871 34.444 50.1997L33.8877 49.3687ZM25.3807 62.0968L24.3997 61.9027C24.1374 63.2287 24 64.5988 24 66H25H26C26 64.7298 26.1245 63.4897 26.3617 62.2908L25.3807 62.0968ZM25 66H24V71H25H26V66H25ZM25 81H24V91H25H26V81H25ZM25 101H24V111H25H26V101H25ZM25 121H24V131H25H26V121H25ZM25 141H24V151H25H26V141H25ZM25 161H24V171H25H26V161H25ZM25 181H24V191H25H26V181H25ZM25 201H24V211H25H26V201H25ZM25 221H24V231H25H26V221H25ZM25 241H24V251H25H26V241H25ZM25 261H24V271H25H26V261H25ZM25 281H24V291H25H26V281H25ZM25 301H24V311H25H26V301H25ZM25 321H24V331H25H26V321H25ZM25 341H24V346H25H26V341H25ZM25 346H24C24 347.401 24.1374 348.771 24.3997 350.097L25.3807 349.903L26.3617 349.709C26.1245 348.51 26 347.27 26 346H25ZM28.3687 357.112L27.5377 357.669C29.0706 359.958 31.0417 361.929 33.3314 363.462L33.8877 362.631L34.444 361.8C32.3716 360.413 30.5871 358.628 29.1997 356.556L28.3687 357.112ZM41.0968 365.619L40.9027 366.6C42.2287 366.863 43.5988 367 45 367V366V365C43.7298 365 42.4897 364.875 41.2908 364.638L41.0968 365.619ZM45 366V367H49.8611V366V365H45V366ZM59.5833 366V367H69.3056V366V365H59.5833V366ZM79.0278 366V367H88.75V366V365H79.0278V366ZM98.4722 366V367H108.194V366V365H98.4722V366ZM117.917 366V367H127.639V366V365H117.917V366ZM137.361 366V367H147.083V366V365H137.361V366ZM156.806 366V367H166.528V366V365H156.806V366ZM176.25 366V367H185.972V366V365H176.25V366ZM195.694 366V367H205.417V366V365H195.694V366ZM215.139 366V367H224.861V366V365H215.139V366ZM234.583 366V367H244.306V366V365H234.583V366ZM254.028 366V367H263.75V366V365H254.028V366ZM273.472 366V367H283.195V366V365H273.472V366ZM292.917 366V367H302.639V366V365H292.917V366ZM312.361 366V367H322.083V366V365H312.361V366ZM331.806 366V367H341.528V366V365H331.806V366ZM351.25 366V367H360.972V366V365H351.25V366ZM370.695 366V367H380.417V366V365H370.695V366ZM390.139 366V367H395V366V365H390.139V366ZM395 366V367C397.168 367 399.237 366.568 401.125 365.786L400.742 364.862L400.359 363.938C398.709 364.622 396.9 365 395 365V366ZM408.862 356.742L409.786 357.125C410.568 355.237 411 353.168 411 351H410H409C409 352.9 408.622 354.709 407.938 356.359L408.862 356.742ZM410 351H411V347H410H409V351H410ZM410 339H411V331H410H409V339H410ZM410 323H411V319H410H409V323H410ZM410 319H411C411 317.1 411.378 315.291 412.062 313.641L411.138 313.258L410.214 312.875C409.432 314.763 409 316.832 409 319H410ZM419.258 305.138L419.641 306.062C421.291 305.378 423.1 305 425 305V304V303C422.832 303 420.763 303.432 418.875 304.214L419.258 305.138ZM425 304V305H429V304V303H425V304ZM437 304V305H445V304V303H437V304ZM453 304V305H457V304V303H453V304ZM457 304V305C459.168 305 461.237 304.568 463.125 303.786L462.742 302.862L462.359 301.938C460.709 302.622 458.9 303 457 303V304ZM470.862 294.742L471.786 295.125C472.568 293.237 473 291.168 473 289H472H471C471 290.9 470.622 292.709 469.938 294.359L470.862 294.742ZM472 289H473V283.932H472H471V289H472ZM472 273.795H473V263.659H472H471V273.795H472ZM472 253.523H473V243.386H472H471V253.523H472ZM472 233.25H473V223.114H472H471V233.25H472ZM472 212.977H473V202.841H472H471V212.977H472ZM472 192.705H473V182.568H472H471V192.705H472ZM472 172.432H473V162.295H472H471V172.432H472ZM472 152.159H473V142.023H472H471V152.159H472ZM472 131.886H473V121.75H472H471V131.886H472ZM472 111.614H473V101.477H472H471V111.614H472ZM472 91.3408H473V81.2045H472H471V91.3408H472ZM472 71.0681H473V66H472H471V71.0681H472ZM472 66H474C474 64.5333 473.856 63.0982 473.581 61.7086L471.619 62.0968L469.657 62.4849C469.882 63.6202 470 64.7953 470 66H472ZM468.631 54.8877L470.293 53.775C468.688 51.3768 466.623 49.3124 464.225 47.7068L463.112 49.3687L462 51.0306C463.963 52.3454 465.655 54.0365 466.969 56.0003L468.631 54.8877ZM455.903 46.3807L456.291 44.4187C454.902 44.1438 453.467 44 452 44V46V48C453.205 48 454.38 48.1181 455.515 48.3427L455.903 46.3807ZM452 46V44H446.913V46V48H452V46ZM436.737 46V44H426.562V46V48H436.737V46ZM416.388 46V44H406.212V46V48H416.388V46ZM396.038 46V44H385.862V46V48H396.038V46ZM375.688 46V44H365.512V46V48H375.688V46ZM355.337 46V44H345.162V46V48H355.337V46ZM334.987 46V44H324.812V46V48H334.987V46ZM314.637 46V44H304.462V46V48H314.637V46ZM294.287 46V44H284.112V46V48H294.287V46ZM273.937 46V44H263.762V46V48H273.937V46ZM253.587 46V44H243.412V46V48H253.587V46ZM233.237 46V44H223.062V46V48H233.237V46ZM212.887 46V44H202.712V46V48H212.887V46ZM192.537 46V44H182.362V46V48H192.537V46ZM172.187 46V44H162.012V46V48H172.187V46ZM151.837 46V44H141.662V46V48H151.837V46ZM131.488 46V44H121.313V46V48H131.488V46ZM111.138 46V44H100.963V46V48H111.138V46ZM90.7876 46V44H80.6126V46V48H90.7876V46ZM70.4376 46V44H60.2626V46V48H70.4376V46ZM50.0876 46V44H45V46V48H50.0876V46ZM45 46V44C43.5333 44 42.0982 44.1438 40.7086 44.4187L41.0967 46.3807L41.4849 48.3427C42.6202 48.1181 43.7953 48 45 48V46ZM33.8877 49.3687L32.775 47.7068C30.3768 49.3124 28.3123 51.3768 26.7068 53.775L28.3687 54.8877L30.0306 56.0003C31.3453 54.0365 33.0365 52.3454 35.0003 51.0306L33.8877 49.3687ZM25.3807 62.0968L23.4187 61.7086C23.1438 63.0982 23 64.5333 23 66H25H27C27 64.7953 27.1181 63.6202 27.3427 62.4849L25.3807 62.0968ZM25 66H23V71H25H27V66H25ZM25 81H23V91H25H27V81H25ZM25 101H23V111H25H27V101H25ZM25 121H23V131H25H27V121H25ZM25 141H23V151H25H27V141H25ZM25 161H23V171H25H27V161H25ZM25 181H23V191H25H27V181H25ZM25 201H23V211H25H27V201H25ZM25 221H23V231H25H27V221H25ZM25 241H23V251H25H27V241H25ZM25 261H23V271H25H27V261H25ZM25 281H23V291H25H27V281H25ZM25 301H23V311H25H27V301H25ZM25 321H23V331H25H27V321H25ZM25 341H23V346H25H27V341H25ZM25 346H23C23 347.467 23.1438 348.902 23.4187 350.291L25.3807 349.903L27.3427 349.515C27.1181 348.38 27 347.205 27 346H25ZM28.3687 357.112L26.7068 358.225C28.3124 360.623 30.3768 362.688 32.775 364.293L33.8877 362.631L35.0003 360.969C33.0365 359.655 31.3454 357.963 30.0306 356L28.3687 357.112ZM41.0968 365.619L40.7086 367.581C42.0982 367.856 43.5333 368 45 368V366V364C43.7953 364 42.6202 363.882 41.4849 363.657L41.0968 365.619ZM45 366V368H49.8611V366V364H45V366ZM59.5833 366V368H69.3056V366V364H59.5833V366ZM79.0278 366V368H88.75V366V364H79.0278V366ZM98.4722 366V368H108.194V366V364H98.4722V366ZM117.917 366V368H127.639V366V364H117.917V366ZM137.361 366V368H147.083V366V364H137.361V366ZM156.806 366V368H166.528V366V364H156.806V366ZM176.25 366V368H185.972V366V364H176.25V366ZM195.694 366V368H205.417V366V364H195.694V366ZM215.139 366V368H224.861V366V364H215.139V366ZM234.583 366V368H244.306V366V364H234.583V366ZM254.028 366V368H263.75V366V364H254.028V366ZM273.472 366V368H283.195V366V364H273.472V366ZM292.917 366V368H302.639V366V364H292.917V366ZM312.361 366V368H322.083V366V364H312.361V366ZM331.806 366V368H341.528V366V364H331.806V366ZM351.25 366V368H360.972V366V364H351.25V366ZM370.695 366V368H380.417V366V364H370.695V366ZM390.139 366V368H395V366V364H390.139V366ZM395 366V368C397.301 368 399.501 367.542 401.508 366.709L400.742 364.862L399.976 363.014C398.446 363.649 396.766 364 395 364V366ZM408.862 356.742L410.709 357.508C411.542 355.501 412 353.301 412 351H410H408C408 352.766 407.649 354.446 407.014 355.976L408.862 356.742ZM410 351H412V347H410H408V351H410ZM410 339H412V331H410H408V339H410ZM410 323H412V319H410H408V323H410ZM410 319H412C412 317.234 412.351 315.554 412.986 314.024L411.138 313.258L409.291 312.492C408.458 314.499 408 316.699 408 319H410ZM419.258 305.138L420.024 306.986C421.554 306.351 423.234 306 425 306V304V302C422.699 302 420.499 302.458 418.492 303.291L419.258 305.138ZM425 304V306H429V304V302H425V304ZM437 304V306H445V304V302H437V304ZM453 304V306H457V304V302H453V304ZM457 304V306C459.301 306 461.501 305.542 463.508 304.709L462.742 302.862L461.976 301.014C460.446 301.649 458.766 302 457 302V304ZM470.862 294.742L472.709 295.508C473.542 293.501 474 291.301 474 289H472H470C470 290.766 469.649 292.446 469.014 293.976L470.862 294.742ZM472 289H474V283.932H472H470V289H472ZM472 273.795H474V263.659H472H470V273.795H472ZM472 253.523H474V243.386H472H470V253.523H472ZM472 233.25H474V223.114H472H470V233.25H472ZM472 212.977H474V202.841H472H470V212.977H472ZM472 192.705H474V182.568H472H470V192.705H472ZM472 172.432H474V162.295H472H470V172.432H472ZM472 152.159H474V142.023H472H470V152.159H472ZM472 131.886H474V121.75H472H470V131.886H472ZM472 111.614H474V101.477H472H470V111.614H472ZM472 91.3408H474V81.2045H472H470V91.3408H472ZM472 71.0681H474V66H472H470V71.0681H472Z"
											fill="#7B7B7B"
											mask="url(#path-1-inside-1_3456_24671)"
										/>
									</g>
									<defs>
										<filter
											id="filter0_ddd_3456_24671"
											x="-6"
											y="0"
											width="1082"
											height="911"
											filterUnits="userSpaceOnUse"
											color-interpolation-filters="sRGB"
										>
											<feFlood flood-opacity="0" result="BackgroundImageFix" />
											<feColorMatrix
												in="SourceAlpha"
												type="matrix"
												values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
												result="hardAlpha"
											/>
											<feOffset dx="99" dy="84" />
											<feGaussianBlur stdDeviation="65" />
											<feColorMatrix
												type="matrix"
												values="0 0 0 0 0.588235 0 0 0 0 0.588235 0 0 0 0 0.588235 0 0 0 0.09 0"
											/>
											<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_3456_24671" />
											<feColorMatrix
												in="SourceAlpha"
												type="matrix"
												values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
												result="hardAlpha"
											/>
											<feOffset dx="223" dy="189" />
											<feGaussianBlur stdDeviation="87.5" />
											<feColorMatrix
												type="matrix"
												values="0 0 0 0 0.588235 0 0 0 0 0.588235 0 0 0 0 0.588235 0 0 0 0.05 0"
											/>
											<feBlend
												mode="normal"
												in2="effect1_dropShadow_3456_24671"
												result="effect2_dropShadow_3456_24671"
											/>
											<feColorMatrix
												in="SourceAlpha"
												type="matrix"
												values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
												result="hardAlpha"
											/>
											<feOffset dx="396" dy="337" />
											<feGaussianBlur stdDeviation="104" />
											<feColorMatrix
												type="matrix"
												values="0 0 0 0 0.588235 0 0 0 0 0.588235 0 0 0 0 0.588235 0 0 0 0.01 0"
											/>
											<feBlend
												mode="normal"
												in2="effect2_dropShadow_3456_24671"
												result="effect3_dropShadow_3456_24671"
											/>
											<feBlend mode="normal" in="SourceGraphic" in2="effect3_dropShadow_3456_24671" result="shape" />
										</filter>
									</defs>
								</svg>
								<!-- Кнопка добавления -->
								<div class="portfolio-item portfolio-item--add" id="portfolioAddBtn">
									<div class="portfolio-item__plus-4">
										<input
											type="file"
											name="portfolio[]"
											id="portfolioInput"
											accept="image/jpeg,image/png,image/webp"
											multiple
											class="portfolio-item__input"
										/>
										<svg
											class="plus-svg"
											width="16"
											height="16"
											viewBox="0 0 16 16"
											fill="#fff"
											xmlns="http://www.w3.org/2000/svg"
										>
											<path
												d="M8.4 0C8.61217 0 8.81566 0.0842856 8.96569 0.234315C9.11572 0.384344 9.2 0.587827 9.2 0.8V6.8H15.2C15.4122 6.8 15.6157 6.88429 15.7657 7.03431C15.9157 7.18434 16 7.38783 16 7.6V8.4C16 8.61217 15.9157 8.81566 15.7657 8.96569C15.6157 9.11572 15.4122 9.2 15.2 9.2H9.2V15.2C9.2 15.4122 9.11572 15.6157 8.96569 15.7657C8.81566 15.9157 8.61217 16 8.4 16H7.6C7.38783 16 7.18434 15.9157 7.03431 15.7657C6.88429 15.6157 6.8 15.4122 6.8 15.2V9.2H0.8C0.587827 9.2 0.384344 9.11572 0.234315 8.96569C0.0842856 8.81566 0 8.61217 0 8.4V7.6C0 7.38783 0.0842856 7.18434 0.234315 7.03431C0.384344 6.88429 0.587827 6.8 0.8 6.8H6.8V0.8C6.8 0.587827 6.88429 0.384344 7.03431 0.234315C7.18434 0.0842856 7.38783 0 7.6 0H8.4Z"
											/>
										</svg>
									</div>
								</div>
							</div>
						</div>
					</section>

					<!-- Кнопка сохранения -->
					<div class="profile-actions">
						<button type="submit" class="profile-btn profile-btn--primary">Сохранить</button>
					</div>
				</form>
			</div>
		</main>

		<script src="/assets/js/login-registration.js"></script>
	</body>
</html>
