<a href="https://wa.me/5217721115821" class="btn-float btn-whatsapp" target="_blank" title="Contáctanos por WhatsApp">
    <i class="fa-brands fa-whatsapp"></i>
</a>

<a href="https://www.facebook.com/share/15WuC76jMQ/" class="btn-float btn-facebook" target="_blank" title="Visítanos en Facebook">
    <i class="fa-brands fa-facebook-f"></i>
</a>

<script src="https://kit.fontawesome.com/56497fa989.js" crossorigin="anonymous"></script>

<style>
    .btn-float {
        position: fixed;
        bottom: 20px;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        font-size: 35px;
        text-align: center;
        line-height: 50px;
        color: white;
        z-index: 999;
        transition: background 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }

    .btn-whatsapp {
        right: 20px;
        background-color: #25d366;
    }

    .btn-facebook {
        left: 20px;
        background-color: #1877f2;
    }

    .btn-float:hover {
        filter: brightness(1.1);
        text-decoration: none;
    }

    @media (max-width: 768px) {
        .btn-float {
            width: 40px;
            height: 40px;
            font-size: 28px;
            line-height: 40px;
        }
    }
</style>