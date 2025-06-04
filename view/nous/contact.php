<?php
require_once('view/layout/nav_bar.php');

?>
    <style>
        
        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 50px;
        }

        .contact-form-section {
            background: linear-gradient(135deg, #93a5fc 0%, #dbb9fd 100%);
            border-radius: 25px;
            padding: 40px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            text-align: center;
            color: black;
            animation: slideInLeft 0.8s ease-out;
        }

        .contact-form-section textarea {
            width: 90%;
            height: 100px;
        }

        .contact-info-section {
            display: flex;
            flex-direction: column;
            gap: 25px;
            animation: slideInRight 0.8s ease-out;
        }

        .form-title {
            font-size: 2rem;
            color: #333;
            margin-bottom: 10px;
            text-align: center;
        }

        .form-subtitle {
            color: #666;
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.1rem;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            color: #333;
            font-weight: bold;
            margin-bottom: 8px;
            font-size: 1.1rem;
        }

        .form-input, .form-textarea, .form-select {
            width: 100%;
            padding: 15px;
            border: 2px solid #e0e0e0;
            border-radius: 15px;
            font-size: 1rem;
            font-family: inherit;
            transition: all 0.3s ease;
            background: #fff;
        }

        .form-input:focus, .form-textarea:focus, .form-select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 15px rgba(102, 126, 234, 0.2);
            transform: translateY(-2px);
        }

        .form-textarea {
            resize: vertical;
            min-height: 120px;
        }

        .form-button {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 15px 40px;
            font-size: 1.2rem;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: inherit;
            display: block;
            margin: 30px auto 0;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        .form-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.3);
            background: linear-gradient(45deg, #5a67d8, #6b46c1);
        }

        .contact-card {
            background: linear-gradient(135deg, #93a5fc 0%, #dbb9fd 100%);
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 3px solid transparent;
        }

        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
            border-color: #667eea;
            background: linear-gradient(135deg, #dbb9fd 0%, #93a5fc 100%);
        }

        .contact-icon {
            font-size: 3rem;
            margin-bottom: 15px;
            display: block;
        }

        .contact-title {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 10px;
        }

        .contact-details {
            color: #666;
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .contact-link {
            color: #667eea;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .contact-link:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .social-section {
            background: linear-gradient(135deg, #93a5fc 0%, #dbb9fd 100%);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            color: black;
            border-radius: 25px;
            padding: 40px;
            text-align: center;
            animation: fadeInUp 1s ease-out;
        }

        .social-title {
            font-size: 2rem;
            color: #333;
            margin-bottom: 20px;
        }

        .social-subtitle {
            color: #666;
            margin-bottom: 30px;
            font-size: 1.1rem;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .social-link {
            display: inline-block;
            padding: 15px 25px;
            background: linear-gradient(45deg, #ff6b6b, #feca57);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .social-link:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }

        .social-link.facebook { background: linear-gradient(45deg, #3b5998, #4267B2); }
        .social-link.twitter { background: linear-gradient(45deg, #1da1f2, #0d8bd9); }
        .social-link.linkedin { background: linear-gradient(45deg, #0077b5, #005885); }
        .social-link.whatsapp { background: linear-gradient(45deg, #25d366, #128c7e); }

        .floating-elements {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .floating-message, .floating-heart, .floating-star {
            position: absolute;
            font-size: 2rem;
            opacity: 0.6;
            animation: float 8s ease-in-out infinite;
        }

        .floating-message {
            top: 15%;
            left: 5%;
            animation-delay: 0s;
        }

        .floating-heart {
            top: 70%;
            right: 10%;
            animation-delay: 3s;
        }

        .floating-star {
            top: 40%;
            left: 85%;
            animation-delay: 6s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-15px) rotate(5deg); }
            66% { transform: translateY(-5px) rotate(-3deg); }
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-50px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-100px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(100px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .contact-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            
            .contact-form-section, .contact-info-section {
                animation: fadeInUp 0.8s ease-out;
            }
            
            .page-title {
                font-size: 2.2rem;
            }
            
            .social-links {
                gap: 15px;
            }
            
            .social-link {
                padding: 12px 20px;
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 15px;
            }
            
            .contact-form-section, .social-section {
                padding: 25px 20px;
            }
            
            .contact-card {
                padding: 25px 20px;
            }
            
            .page-title {
                font-size: 1.8rem;
            }
            
            .social-links {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>


    <div class="floating-elements">
        <div class="floating-message">💌</div>
        <div class="floating-heart">💝</div>
        <div class="floating-star">⭐</div>
    </div>

    <div class="container">
        <div class="page-header">
            <h1 class="page-title">📞 Contactez-nous</h1>
            <p class="page-subtitle">
                Nous sommes là pour vous accompagner dans votre parcours d'apprentissage. 
                N'hésitez pas à nous faire part de vos questions, suggestions ou simplement à nous dire bonjour ! 😊
            </p>
        </div>

        <?php
            if (isset($msg) && isset($msg_type)) {?>
                <div class="alert alert-<?=$msg_type?> alert-dismissible fade show" role="alert">
                    <strong><?=$msg?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div><?php
            }
            ?>
        <div class="contact-grid">
            <div class="contact-form-section">
                <h2 class="form-title">💬 Envoyez-nous un message</h2>
                <p class="form-subtitle">Nous vous répondrons dans les plus brefs délais</p>
                
                <form id="contact-form" action="index.php?path=contact/message" method="post">
                    <div class="form-group">
                        <label for="name" class="form-label">👤 Votre nom complet</label>
                        <input type="text" id="name" name="nom" class="filter-input" required 
                               placeholder="Ex: Jean Dupont">
                    </div>
                    
                    <div class="form-group">
                        <label for="email" class="form-label">📧 Votre email</label>
                        <input type="email" id="email" name="email" class="filter-input" required 
                               placeholder="votre.email@exemple.com">
                    </div>
                    
                    <div class="form-group">
                        <label for="subject" class="form-label">📋 Sujet de votre message</label>
                        <select id="subject" name="sujet" class="filter-select" required>
                            <option value="">Choisissez un sujet...</option>
                            <option value="question">❓ Question générale</option>
                            <option value="bug">🐛 Signaler un problème</option>
                            <option value="suggestion">💡 Suggestion d'amélioration</option>
                            <option value="partenariat">🤝 Proposition de partenariat</option>
                            <option value="support">🆘 Support technique</option>
                            <option value="autre">📝 Autre</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="message" class="form-label">💭 Votre message</label>
                        <textarea id="message" name="message" class="filter-input" required 
                                  placeholder="Décrivez votre demande en détail..."></textarea>
                    </div>
                    
                    <button type="submit" class="cta-button">
                        Envoyer le message 🚀
                    </button>
                </form>
            </div>

            <div class="contact-info-section">
                <div class="contact-card" onclick="window.open('mailto:eduquizplus@gmail.com')">
                    <span class="contact-icon">📧</span>
                    <h3 class="contact-title">Email</h3>
                    <div class="contact-details">
                        <a href="mailto:eduquizplus@gmail.com" class="contact-link">eduquizplus@gmail.com</a><br>
                        <small>Réponse sous 24h</small>
                    </div>
                </div>

                <div class="contact-card" onclick="window.open('tel:+237658995265')">
                    <span class="contact-icon">📱</span>
                    <h3 class="contact-title">Téléphone</h3>
                    <div class="contact-details">
                        <a href="tel:+237658995265" class="contact-link">+237 658 995 265</a><br>
                        <small>Lun-Ven: 8h-18h (GMT+1)</small>
                    </div>
                </div>

                <div class="contact-card">
                    <span class="contact-icon">🏢</span>
                    <h3 class="contact-title">Adresse</h3>
                    <div class="contact-details">
                        Douala<br>
                        Littoral, Cameroun<br>
                        <small>Siège social</small>
                    </div>
                </div>

                <div class="contact-card">
                    <span class="contact-icon">⏰</span>
                    <h3 class="contact-title">Horaires</h3>
                    <div class="contact-details">
                        Lundi - Vendredi<br>
                        8h00 - 18h00 (GMT+1)<br>
                        <small>Support disponible</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="social-section">
            <h2 class="social-title">🌟 Suivez-nous</h2>
            <p class="social-subtitle">Restez connectés avec notre communauté d'apprenants !</p>
            
            <div class="social-links">
                <a href="#" class="social-link facebook">📘 Facebook</a>
                <a href="#" class="social-link twitter">🐦 Twitter</a>
                <a href="#" class="social-link linkedin">💼 LinkedIn</a>
                <a href="#" class="social-link whatsapp">💬 WhatsApp</a>
            </div>
        </div>
    </div>

    <script>
        function submitForm(event) {
            event.preventDefault();
            
            // Animation de succès
            const button = event.target.querySelector('.form-button');
            const originalText = button.textContent;
            
            button.textContent = '✅ Message envoyé !';
            button.style.background = 'linear-gradient(45deg, #4caf50, #66bb6a)';
            
            // Simulation d'envoi
            setTimeout(() => {
                alert('🎉 Merci pour votre message ! Nous vous répondrons très bientôt. 😊');
                
                // Reset du formulaire
                document.getElementById('contact-form').reset();
                button.textContent = originalText;
                button.style.background = 'linear-gradient(45deg, #667eea, #764ba2)';
            }, 1000);
        }

    </script>
</body>
</html>