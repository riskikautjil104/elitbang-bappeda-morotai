<style>
   /* Page Header */
   .badge-jenis-penelitian,
   .badge-jenis-pengembangan {
      padding: 8px 16px;
      border-radius: 20px;
      font-size: 0.9rem;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 6px;
   }

   .badge-jenis-penelitian {
      background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
      color: white;
   }

   .badge-jenis-pengembangan {
      background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
      color: white;
   }

   .btn-back {
      background: white;
      color: #1a5f7a;
      border: none;
      padding: 10px 25px;
      border-radius: 25px;
      font-weight: 600;
      transition: all 0.3s ease;
   }

   .btn-back:hover {
      background: rgba(255,255,255,0.9);
      transform: translateX(-5px);
      color: #1a5f7a;
   }

   /* Detail Cards */
   .detail-card {
      background: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      transition: all 0.3s ease;
   }

   .detail-card:hover {
      box-shadow: 0 4px 12px rgba(0,0,0,0.12);
   }

   .detail-card-header {
      background: linear-gradient(135deg, #1a5f7a 0%, #159895 100%);
      color: white;
      padding: 15px 20px;
      display: flex;
      align-items: center;
      font-weight: 600;
   }

   .detail-card-header.header-success {
      background: linear-gradient(135deg, #55efc4 0%, #00b894 100%);
   }

   .detail-card-header.header-info {
      background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
   }

   .detail-card-header h5 {
      margin: 0;
      font-size: 1.1rem;
   }

   .detail-card-header i {
      font-size: 1.2rem;
   }

   .detail-card-body {
      padding: 25px;
   }

   /* Info Items */
   .info-item label {
      font-size: 0.85rem;
      color: #718096;
      margin-bottom: 5px;
      display: block;
      font-weight: 600;
   }

   .info-item p {
      font-size: 1rem;
      color: #2d3748;
      margin: 0;
      font-weight: 500;
   }

   .badge-info-penelitian,
   .badge-info-pengembangan {
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 0.85rem;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 5px;
   }

   .badge-info-penelitian {
      background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
      color: white;
   }

   .badge-info-pengembangan {
      background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
      color: white;
   }

   /* Content Text */
   .section-label {
      font-size: 0.9rem;
      color: #718096;
      font-weight: 600;
      display: block;
      margin-bottom: 10px;
   }

   .content-text {
      font-size: 1rem;
      line-height: 1.7;
      color: #4a5568;
   }

   /* Progress Bar */
   .progress-wrapper {
      margin-top: 10px;
   }

   .progress {
      height: 30px;
      border-radius: 15px;
      background: #e2e8f0;
      overflow: hidden;
   }

   .progress-bar {
      background: linear-gradient(135deg, #55efc4 0%, #00b894 100%);
      font-weight: 600;
      font-size: 0.95rem;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: width 0.6s ease;
   }

   /* Document Cards */
   .document-card {
      background: #f8f9fa;
      border-radius: 10px;
      padding: 15px;
      display: flex;
      gap: 15px;
      align-items: flex-start;
      transition: all 0.3s ease;
      height: 100%;
   }

   .document-card:hover {
      background: #e8f4f8;
   }

   .document-icon {
      width: 50px;
      height: 50px;
      background: linear-gradient(135deg, #1a5f7a 0%, #159895 100%);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
   }

   .document-icon i {
      font-size: 24px;
      color: white;
   }

   .document-info {
      flex: 1;
   }

   .document-info h6 {
      margin-bottom: 5px;
      color: #2d3748;
      font-weight: 600;
      font-size: 0.95rem;
   }

   .document-info p {
      margin-bottom: 10px;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
   }

   .btn-download {
      background: linear-gradient(135deg, #1a5f7a 0%, #159895 100%);
      color: white;
      border: none;
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 0.85rem;
      font-weight: 600;
      transition: all 0.3s ease;
   }

   .btn-download:hover {
      background: linear-gradient(135deg, #159895 0%, #1a5f7a 100%);
      color: white;
      transform: translateY(-2px);
   }

   /* Sidebar Cards */
   .sidebar-card {
      background: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
   }

   .sidebar-card-header {
      background: linear-gradient(135deg, #2d3748 0%, #1a202c 100%);
      color: white;
      padding: 15px 20px;
      display: flex;
      align-items: center;
      font-weight: 600;
   }

   .sidebar-card-header.header-share {
      background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
   }

   .sidebar-card-header.header-download {
      background: linear-gradient(135deg, #55efc4 0%, #00b894 100%);
   }

   .sidebar-card-header h5 {
      margin: 0;
      font-size: 1rem;
   }

   .sidebar-card-header i {
      font-size: 1.1rem;
   }

   .sidebar-card-body {
      padding: 20px;
   }

   .sidebar-info-item {
      margin-bottom: 20px;
   }

   .sidebar-info-item:last-child {
      margin-bottom: 0;
   }

   .sidebar-info-item label {
      font-size: 0.85rem;
      color: #718096;
      margin-bottom: 5px;
      display: block;
      font-weight: 600;
   }

   .sidebar-info-item p {
      font-size: 0.95rem;
      color: #2d3748;
      margin: 0;
      font-weight: 500;
   }

   /* Status Badges */
   .status-warning {
      background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
      color: #2d3436;
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.85rem;
      font-weight: 600;
   }

   .status-success {
      background: linear-gradient(135deg, #55efc4 0%, #00b894 100%);
      color: white;
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.85rem;
      font-weight: 600;
   }

   .status-orange {
      background: linear-gradient(135deg, #fab1a0 0%, #ff7675 100%);
      color: white;
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.85rem;
      font-weight: 600;
   }

   .status-danger {
      background: linear-gradient(135deg, #ff7675 0%, #d63031 100%);
      color: white;
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.85rem;
      font-weight: 600;
   }

   .status-secondary {
      background: linear-gradient(135deg, #dfe6e9 0%, #b2bec3 100%);
      color: #2d3436;
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.85rem;
      font-weight: 600;
   }

   /* Social Share */
   .social-share {
      display: flex;
      gap: 10px;
      justify-content: center;
   }

   .btn-social {
      width: 45px;
      height: 45px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 20px;
      transition: all 0.3s ease;
      text-decoration: none;
   }

   .btn-social:hover {
      transform: translateY(-3px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
   }

   .btn-facebook {
      background: linear-gradient(135deg, #3b5998 0%, #2d4373 100%);
   }

   .btn-twitter {
      background: linear-gradient(135deg, #1da1f2 0%, #0c85d0 100%);
   }

   .btn-whatsapp {
      background: linear-gradient(135deg, #25d366 0%, #1ebe57 100%);
   }

   /* Download All Button */
   .btn-download-all {
      background: linear-gradient(135deg, #55efc4 0%, #00b894 100%);
      color: white;
      border: none;
      padding: 12px 20px;
      border-radius: 8px;
      font-weight: 600;
      display: block;
      width: 100%;
      text-align: center;
      transition: all 0.3s ease;
      text-decoration: none;
   }

   .btn-download-all:hover {
      background: linear-gradient(135deg, #00b894 0%, #55efc4 100%);
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0,184,148,0.3);
   }

   /* Responsive */
   @media (max-width: 768px) {
      .page-header {
         padding: 40px 0 !important;
      }

      .page-title {
         font-size: 1.5rem !important;
      }

      .detail-card-body {
         padding: 20px;
      }

      .document-card {
         flex-direction: column;
         text-align: center;
      }

      .document-icon {
         margin: 0 auto;
      }
   }
</style>