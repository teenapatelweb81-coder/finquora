<script src="https://cdn.tailwindcss.com"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    .card-hover {
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .card-hover:hover {
      transform: translateY(-12px) scale(1.02);
      box-shadow: 0 25px 50px -12px rgb(3 112 181 / 0.25);
    }

    .hero-gradient {
      background: linear-gradient(135deg, #0370b5 0%, #0f8740 100%);
    }

    .brand-blue { color: #0370b5; }
    .brand-green { color: #0f8740; }

    .tail-container {
      max-width: 1280px;
      margin-left: auto;
      margin-right: auto;
    }

    .modal-content {
      animation: modalPop 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    @keyframes modalPop {
      from {
        opacity: 0;
        transform: scale(0.8) translateY(50px);
      }
      to {
        opacity: 1;
        transform: scale(1) translateY(0);
      }
    }

    .product-logo {
      transition: transform 0.4s ease;
    }
   /* .card-hover:hover .product-logo  {
      transform: scale(1.15) rotate(8deg);
    } */
      button:focus{
      outline:unset;
    }
     @media (min-width: 1536px) {
    .container {
        max-width: 1280px;
    }
    }
  </style>
</head>

  <!-- Top Navigation -->
  <!-- <nav class="bg-white shadow-sm border-b  z-50">
    <div class="tail-container px-6 py-5 flex justify-between items-center">
      <div class="flex items-center gap-3">
        <div class="w-10 h-10 bg-gradient-to-br from-[#0370b5] to-[#0f8740] rounded-2xl flex items-center justify-center text-white text-2xl font-bold">F</div>
        <h1 class="text-3xl font-bold tracking-tight">
          <span class="brand-blue">Fin</span><span class="brand-green">quora</span>
        </h1>
      </div>
      
      <div class="flex items-center gap-4">
        <input type="text" placeholder="Search loans, partners..." 
               class="px-5 py-3 border border-gray-200 rounded-2xl w-96 focus:outline-none focus:border-[#0370b5] transition-all">
        <button onclick="alert('Restriction applied!')" 
                class="bg-gradient-to-r from-[#0370b5] to-[#0f8740] text-white px-6 py-3 rounded-2xl font-semibold hover:shadow-lg transition-all">
          Apply Restriction
        </button>
      </div>
    </div>
  </nav> -->

  <!-- Hero Banner -->

  <!-- Enhanced Hero Section -->
<div class="grid md:grid-cols-2 gap-0 min-h-[85vh]">

  <!-- LEFT HALF - Loan Offers -->
  <div class="hero-gradient text-white py-20 relative overflow-hidden flex items-center">
    <div class="tail-container px-3">
      <div class="max-w-3xl">
        <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-md px-5 py-2 rounded-3xl mb-6">
          <span class="text-sm font-medium"><?php echo isset($hero_banners) && !empty($hero_banners) ? $hero_banners->badge_text : ''; ?></span>
        </div>

        <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold leading-tight mb-6">
          <?php echo isset($hero_banners) && !empty($hero_banners) ? $hero_banners->main_heading : ''; ?>
        </h1>

        <p class="text-xl md:text-2xl opacity-90 mb-10">
          <?php echo isset($hero_banners) && !empty($hero_banners) ? $hero_banners->sub_heading : ''; ?>
        </p>

        <div class="flex flex-wrap gap-4">
          <button  onclick="copyLink(window.currentProduct.copy_link)"
                  class="flex items-center gap-3 bg-white/20 hover:bg-white/30 backdrop-blur-md px-8 py-4 rounded-3xl font-semibold transition-all text-lg">
            <i class="fa fa-copy"></i> <?php echo isset($hero_banners) && !empty($hero_banners) ? $hero_banners->cta1_text : 'Copy Link'; ?>
          </button>
          
          <button onclick="document.getElementById('productGrid').scrollIntoView({behavior: 'smooth'})"
                  class="bg-white text-[#0370b5] hover:bg-yellow-300 hover:text-[#0370b5] px-10 py-4 rounded-3xl font-semibold text-lg flex items-center gap-3 transition-all shadow-xl">
            <i class="fa fa-bolt"></i> <?php echo isset($hero_banners) && !empty($hero_banners) ? $hero_banners->cta2_text : 'Check Offers Now'; ?>
          </button>
        </div>

        <!-- Trust Signals -->
        <div class="flex items-center gap-8 mt-12 text-sm opacity-90">
          <?php echo isset($hero_banners) && !empty($hero_banners) ? $hero_banners->trusts : ''; ?>
        </div>
      </div>
    </div>

    <!-- Decorative Elements -->
    <div class="absolute bottom-10 right-10 hidden xl:block">
      <div class="text-[180px] opacity-10">💰</div>
    </div>
  </div>

  <!-- RIGHT HALF - CIBIL Score -->
  <div class="bg-gradient-to-br from-[#f8fbff] to-white flex items-center py-5">
    <div class="tail-container px-2 ">
      <div class="flex flex-col lg:flex-row items-center gap-6">
        
        <!-- Image -->
        <div class="relative flex-shrink-0">
          <img src="<?= base_url('upload/assets/images/credit-score.jpg')?>" 
               alt="CIBIL Score" 
               class="w-full max-w-md lg:max-w-lg drop-shadow-2xl rounded-3xl">
          
          <!-- Floating Badge -->
          <div class="absolute -top-4 -right-4 bg-white shadow-xl rounded-2xl px-6 py-3 flex items-center gap-3">
            <div class="text-3xl">📈</div>
            <div>
              <p class="text-emerald-600 font-bold text-lg"> <?php echo isset($hero_banners) && !empty($hero_banners) ? $hero_banners->score_value : ''; ?></p>
              <p class="text-xs text-gray-500 -mt-1"> <?php echo isset($hero_banners) && !empty($hero_banners) ? $hero_banners->score_label : ''; ?></p>
            </div>
          </div>
        </div>

        <!-- Text Content -->
        <div class="space-y-6 max-w-md">
         <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 leading-tight">
            <?php
            if (isset($hero_banners) && !empty($hero_banners->right_heading)) {
                echo preg_replace(
                    '/CIBIL Score/',
                    '<span class="brand-blue">CIBIL Score</span>',
                    $hero_banners->right_heading,
                    1 // sirf pehli occurrence replace hogi
                );
            }
            ?>
        </h2>
          
          <p class="text-gray-600 text-[17px] leading-relaxed">
            <?php echo isset($hero_banners) && !empty($hero_banners) ? $hero_banners->right_description : ''; ?>
          </p>

          <button onclick="checkCibil()" 
                  class="bg-gradient-to-r from-[#0370b5] to-[#0f8740] text-white px-4 py-3 rounded-2xl font-semibold  hover:scale-105 transition-all shadow-lg flex items-center gap-3">
            <?php echo isset($hero_banners) && !empty($hero_banners) ? $hero_banners->right_cta_text : ''; ?>
            <span class="text-xl">→</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

  <!-- Product Grid -->
  <div class="tail-container px-6 py-12">
    <div class="flex justify-between items-end mb-10">
      <h2 class="text-4xl font-semibold text-gray-900">Premium Loan Products</h2>
      <p class="text-gray-500">Handpicked for maximum conversion</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8" id="productGrid">
      <!-- Populated by JS -->
    </div>
  </div>

  <!-- Product Detail Modal -->
  <div id="detailModal" class="hidden fixed inset-0 bg-black/70 flex items-center justify-center z-[1000] p-4">
    <div class="modal-content bg-white rounded-3xl w-full max-w-5xl max-h-[95vh] overflow-hidden shadow-2xl">
      
      <!-- Modal Header -->
      <div class="p-8 border-b flex justify-between items-start">
        <div class="flex items-center gap-5">
          <div id="modalLogo" class="text-6xl"></div>
          <div>
            <h2 id="modalTitle" class="text-3xl font-bold text-gray-900"></h2>
            <span class="inline-block mt-2 px-5 py-1.5 bg-gradient-to-r from-[#0370b5]/10 to-[#0f8740]/10 text-[#0370b5] rounded-full text-sm font-medium"id="modalType">
              
            </span>
          </div>
        </div>
        <button onclick="closeModal()" class="text-4xl text-gray-400 hover:text-gray-600 transition-colors">×</button>
      </div>

      <div class="p-8 overflow-auto" style="max-height: calc(95vh - 180px);">
        <div id="modalContent"></div>
      </div>

      <!-- Footer Actions -->
      <div class="p-8 border-t bg-gray-50 flex gap-4">
        <button  onclick="copyLink(window.currentProduct.copy_link)" 
                class="flex-1 py-4 border-2 border-gray-300 rounded-2xl font-semibold hover:bg-gray-100 transition-all">
          📋 Copy Link
        </button>
        <button onclick="sellNow(window.currentProduct.sell_link)"
                class="flex-1 py-4 bg-gradient-to-r from-[#0370b5] to-[#0f8740] text-white rounded-2xl font-semibold text-lg hover:shadow-xl transition-all">
          💰 Sell Now
        </button>
      </div>
    </div>
  </div>
<script>
  <?php if (!empty($products)): ?>
    const products = <?= json_encode($products, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS); ?>;
  <?php else: ?>
    const products = [];
  <?php endif; ?>

  function renderProducts() {
    const grid = document.getElementById('productGrid');
    grid.innerHTML = '';

    if (products.length === 0) {
      grid.innerHTML = `<div class="col-span-full text-center text-gray-500 py-20 text-xl">No products available</div>`;
      return;
    }

    products.forEach((product, index) => {
      const card = document.createElement('div');
      card.className = `relative bg-white rounded-3xl p-8 card-hover cursor-pointer border border-gray-100`;
      
      card.innerHTML = `
        <div class="product-logo text-6xl mb-6"><img style="max-width:80px;max-height:80px;margin: auto;" src="${product.logo ? '<?= base_url('beta/') ?>' + product.logo : ''}"></div>
        <h3 class="font-semibold text-2xl mb-2">${product.name || ''}</h3>
        <p class="text-3xl font-bold text-[#0370b5] mb-3">${product.amount || ''}</p>
        <p class="text-emerald-600 font-medium mb-6">${product.benefit || ''}</p>
        <div class="absolute bottom-2.5 left-[15px] w-full">
        <button class="w-[90%] py-4 bg-gradient-to-r from-[#0370b5] to-[#0f8740] text-white rounded-2xl font-semibold hover:shadow-lg transition-all view-detail-btn">
        View Details
        </button>
        </div>
      `;

      // Safe way - no quote issues
      card.querySelector('.view-detail-btn').addEventListener('click', (e) => {
        e.stopPropagation();
        showDetail(product);
      });

      // Optional: whole card clickable
      card.addEventListener('click', () => showDetail(product));

      grid.appendChild(card);
    });
  }

  function showDetail(product) {
    document.getElementById('modalTitle').textContent = product.name || '';
    document.getElementById('modalType').textContent = product.loan_type || '';
   document.getElementById('modalLogo').innerHTML = product.logo
    ? `<img src="<?= base_url('beta/') ?>${product.logo}"
            style="max-width:80px;max-height:80px;margin:auto;object-fit:contain;">`
    : ``;

    // Store current product for tabs
    window.currentProduct = product;

    document.getElementById('modalContent').innerHTML = `
      <div class="space-y-10">
        <div>
          <div class="text-7xl font-bold text-[#0370b5] mb-2">${product.amount || ''}</div>
          <p class="text-gray-600 text-lg leading-relaxed">${product.description || ''}</p>
        </div>

        <div class="grid grid-cols-2 gap-6">
          <div class="bg-gradient-to-br from-[#0370b5]/5 to-transparent p-6 rounded-2xl border border-[#0370b5]/10">
            <p class="text-gray-500">Approval Time</p>
            <p class="text-2xl font-semibold text-[#0370b5]">${product.approval_time || '—'}</p>
          </div>
          <div class="bg-gradient-to-br from-[#0f8740]/5 to-transparent p-6 rounded-2xl border border-[#0f8740]/10">
            <p class="text-gray-500">Processing Fee</p>
            <p class="text-2xl font-semibold text-[#0f8740]">${product.processing_fee || '—'}</p>
          </div>
        </div>

        <!-- Tabs -->
        <div class="border-b">
          <div class="flex gap-8 text-sm flex-wrap">
            <button onclick="changeTab(this, 'benefits')" class="tab-btn pb-4 border-b-2 border-[#0370b5] text-[#0370b5] font-semibold">Benefits</button>
            <button onclick="changeTab(this, 'works')" class="tab-btn pb-4 text-gray-500 hover:text-gray-700">How it Works</button>
            <button onclick="changeTab(this, 'terms')" class="tab-btn pb-4 text-gray-500 hover:text-gray-700">Terms</button>
            <button onclick="changeTab(this, 'sell')" class="tab-btn pb-4 text-gray-500 hover:text-gray-700">Target Customers</button>
          </div>
        </div>

        <div id="tabContent" class="min-h-[300px]"></div>
      </div>
    `;

    document.getElementById('detailModal').classList.remove('hidden');
    changeTab(document.querySelector('.tab-btn'), 'benefits');
  }

  function closeModal() {
    document.getElementById('detailModal').classList.add('hidden');
  }

 function sellNow(link) {

    if (!link) {
        alert("Sell link not available.");
        return;
    }

    window.open(link, "_blank");
}

 async function copyLink(link) {

    if (!link) {
        alert("Link not available.");
        return;
    }

    try {
        await navigator.clipboard.writeText(link);
        alert("✅ Link copied successfully!");
    } catch (e) {
        prompt("Copy this link:", link);
    }
}

  // Dynamic Tab System
  window.changeTab = function(el, type) {
    document.querySelectorAll('.tab-btn').forEach(btn => {
      btn.classList.remove('border-b-2', 'border-[#0370b5]', 'text-[#0370b5]', 'font-semibold');
      btn.classList.add('text-gray-500');
    });
    el.classList.remove('text-gray-500');
    el.classList.add('border-b-2', 'border-[#0370b5]', 'text-[#0370b5]', 'font-semibold');

    const content = document.getElementById('tabContent');
    const p = window.currentProduct || {};

    if (type === 'benefits') {
      // benefits field is space separated string
      const benefits = (p.benefits || '').split(/\s{2,}|\n/).filter(b => b.trim());
      // Better split: common pattern
      const list = (p.benefits || '')
        .replace(/Up to ₹[\d\s]+Lakhs?/gi, match => match)
        .split(/(?=[A-Z])/)   // simple split
        .map(b => b.trim())
        .filter(b => b.length > 3);

      // Safer approach
      let items = [];
      if (p.benefits) {
        // Try to split by common patterns
        items = p.benefits
          .split(/(?=Up to|Instant|Zero|No |Flexible)/i)
          .map(i => i.trim())
          .filter(i => i);
      }

      if (items.length === 0) {
        items = ['Up to ₹5 Lakhs', 'Instant Approvals', 'Zero Hidden Charges', 'No Collateral Required', 'Flexible Repayment'];
      }

      content.innerHTML = `
        <ul class="space-y-4">
          ${items.map(item => `
            <li class="flex items-center gap-3">
              <span class="text-[#0f8740]">✅</span> ${item}
            </li>
          `).join('')}
        </ul>`;
    } 
    else if (type === 'works') {
      // how_it_works is like: "Apply Online: Fill... Upload Documents: ... Get Money: ..."
      let steps = [];
      if (p.how_it_works) {
        steps = p.how_it_works
          .split(/(?=Apply Online|Upload Documents|Get Money)/i)
          .map(s => s.trim())
          .filter(s => s);
      }

      if (steps.length === 0) {
        steps = [
          'Apply Online: Fill simple form in 2 minutes',
          'Upload Documents: Minimal KYC required',
          'Get Money: Disbursal in minutes'
        ];
      }

      content.innerHTML = `
        <div class="space-y-8">
          ${steps.map((step, i) => {
            const [title, ...desc] = step.split(':');
            return `
              <div class="flex gap-6">
                <div class="w-12 h-12 rounded-2xl bg-[#0370b5] text-white flex items-center justify-center font-bold text-xl shrink-0">${i+1}</div>
                <div>
                  <strong>${title.trim()}</strong>
                  <p class="text-gray-600">${desc.join(':').trim() || ''}</p>
                </div>
              </div>
            `;
          }).join('')}
        </div>`;
    } 
    else if (type === 'terms') {
      let terms = [];
      if (p.terms) {
        terms = p.terms
          .split(/(?=Age:|Indian|Minimum)/i)
          .map(t => t.trim())
          .filter(t => t);
      }

      if (terms.length === 0) {
        terms = ['Age: 21 - 58 years', 'Indian Resident', 'Minimum monthly income ₹25,000'];
      }

      content.innerHTML = `
        <ul class="list-disc pl-6 space-y-3 text-gray-700">
          ${terms.map(t => `<li>${t}</li>`).join('')}
        </ul>`;
    } 
    else if (type === 'sell') {
      let customers = [];
      if (p.target_customers) {
        customers = p.target_customers
          .split(/(?=Salaried|Self Employed|Business|Professionals)/i)
          .map(c => c.trim())
          .filter(c => c);
      }

      if (customers.length === 0) {
        customers = ['Salaried Employees', 'Self Employed', 'Business Owners', 'Professionals'];
      }

      content.innerHTML = `
        <div class="grid grid-cols-2 gap-4">
          ${customers.map(c => `
            <div class="border border-gray-200 rounded-2xl p-6 hover:border-[#0370b5] transition-colors text-center font-medium">
              ${c}
            </div>
          `).join('')}
        </div>`;
    }
  };

  // Initialize
  renderProducts();
</script>