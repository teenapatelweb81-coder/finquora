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
    .card-hover:hover .product-logo {
      transform: scale(1.15) rotate(8deg);
    }
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
  <nav class="bg-white shadow-sm border-b  z-50">
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
  </nav>

  <!-- Hero Banner -->
  <div class="hero-gradient text-white py-16 relative overflow-hidden">
    <div class="tail-container px-6 grid md:grid-cols-2 gap-12 items-center">
      <div class="space-y-6">
        <h2 class="text-5xl md:text-6xl font-bold leading-tight">
          Get the <span class="text-white/90">Best Loan</span> Offers<br>for Your Customers
        </h2>
        <p class="text-xl opacity-90">Instant Personal Loans • Zero Hidden Charges • Quick Disbursal</p>
        
        <div class="flex gap-4 pt-4">
          <button onclick="copyLink()" 
                  class="flex items-center gap-3 bg-white/20 backdrop-blur-md px-8 py-4 rounded-2xl hover:bg-white/30 transition-all font-medium">
            <i class="fas fa-copy"></i> Copy Link
          </button>
          <button onclick="document.getElementById('productGrid').scrollIntoView({behavior: 'smooth'})"
                  class="bg-white text-[#0370b5] px-8 py-4 rounded-2xl font-semibold hover:shadow-xl transition-all flex items-center gap-3">
            <i class="fas fa-bolt"></i> Check Offers Now
          </button>
        </div>
      </div>
      
     <!-- NEW CLEAN ICON + IMAGE STYLE -->
      <div class="hidden md:flex justify-end">
        <div class="relative">
          <div class="w-80 h-80 bg-white/10 backdrop-blur-3xl rounded-[3rem] border border-white/30 flex items-center justify-center overflow-hidden shadow-2xl">
            
            <!-- Big Icon -->
            <div class="text-[180px] drop-shadow-2xl">
              💰
            </div>

            <!-- Optional Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-br from-[#0370b5]/20 to-[#0f8740]/20 rounded-[3rem]"></div>
          </div>

          <!-- Small Floating Label -->
          <div class="absolute -bottom-4 left-1/2 -translate-x-1/2 bg-white text-gray-900 text-sm font-semibold px-6 py-3 rounded-2xl shadow-xl flex items-center gap-2 whitespace-nowrap">
            <span class="text-2xl">₹</span>
            <span>10 Lakh Max</span>
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
            <span class="inline-block mt-2 px-5 py-1.5 bg-gradient-to-r from-[#0370b5]/10 to-[#0f8740]/10 text-[#0370b5] rounded-full text-sm font-medium">
              Personal Loan
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
        <button onclick="copyLink()" 
                class="flex-1 py-4 border-2 border-gray-300 rounded-2xl font-semibold hover:bg-gray-100 transition-all">
          📋 Copy Link
        </button>
        <button onclick="sellNow()" 
                class="flex-1 py-4 bg-gradient-to-r from-[#0370b5] to-[#0f8740] text-white rounded-2xl font-semibold text-lg hover:shadow-xl transition-all">
          💰 Sell Now
        </button>
      </div>
    </div>
  </div>

  <script>
    const products = [
      {
        name: "Poonawalla Fincorp",
        logo: "💰",
        amount: "₹5 Lakhs",
        benefit: "Instant Approval",
        desc: "Get instant personal loan up to ₹5 Lakhs with minimal documentation and zero hidden charges."
      },
      {
        name: "Zype Personal Loan",
        logo: "⚡",
        amount: "₹10 Lakhs",
        benefit: "Fast Disbursal",
        desc: "Quickest personal loan with 100% digital process and competitive interest rates."
      },
      {
        name: "PrefR Personal Loan",
        logo: "🌟",
        amount: "₹7 Lakhs",
        benefit: "Lowest Interest",
        desc: "Best interest rates with flexible repayment options and no collateral required."
      },
      {
        name: "Moneyview",
        logo: "📱",
        amount: "₹5 Lakhs",
        benefit: "Fully Digital",
        desc: "Instant approval in minutes. Paperless process with doorstep disbursement."
      }
    ];

    function renderProducts() {
      const grid = document.getElementById('productGrid');
      grid.innerHTML = '';

      products.forEach(product => {
        const card = document.createElement('div');
        card.className = `bg-white rounded-3xl p-8 card-hover cursor-pointer border border-gray-100`;
        card.innerHTML = `
          <div class="product-logo text-6xl mb-6">${product.logo}</div>
          <h3 class="font-semibold text-2xl mb-2">${product.name}</h3>
          <p class="text-3xl font-bold text-[#0370b5] mb-3">${product.amount}</p>
          <p class="text-emerald-600 font-medium mb-6">${product.benefit}</p>
          
          <button onclick="showDetail('${product.name}', '${product.desc}', '${product.amount}', '${product.logo}')" 
                  class="w-full py-4 bg-gradient-to-r from-[#0370b5] to-[#0f8740] text-white rounded-2xl font-semibold hover:shadow-lg transition-all">
            View Details
          </button>
        `;
        grid.appendChild(card);
      });
    }

    function showDetail(name, desc, amount, logo) {
      document.getElementById('modalTitle').textContent = name;
      document.getElementById('modalLogo').textContent = logo;

      document.getElementById('modalContent').innerHTML = `
        <div class="space-y-10">
          <div>
            <div class="text-7xl font-bold text-[#0370b5] mb-2">${amount}</div>
            <p class="text-gray-600 text-lg leading-relaxed">${desc}</p>
          </div>

          <div class="grid grid-cols-2 gap-6">
            <div class="bg-gradient-to-br from-[#0370b5]/5 to-transparent p-6 rounded-2xl border border-[#0370b5]/10">
              <p class="text-gray-500">Approval Time</p>
              <p class="text-2xl font-semibold text-[#0370b5]">30 Minutes</p>
            </div>
            <div class="bg-gradient-to-br from-[#0f8740]/5 to-transparent p-6 rounded-2xl border border-[#0f8740]/10">
              <p class="text-gray-500">Processing Fee</p>
              <p class="text-2xl font-semibold text-[#0f8740]">Zero</p>
            </div>
          </div>

          <!-- Tabs -->
          <div class="border-b">
            <div class="flex gap-8 text-sm">
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

    function sellNow() {
      alert("🎉 Lead captured! Redirecting to application...");
      closeModal();
    }

    function copyLink() {
      alert("✅ Link copied to clipboard!");
    }

    // Tab System
    window.changeTab = function(el, type) {
      document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('border-b-2', 'border-[#0370b5]', 'text-[#0370b5]', 'font-semibold');
      });
      el.classList.add('border-b-2', 'border-[#0370b5]', 'text-[#0370b5]', 'font-semibold');

      const content = document.getElementById('tabContent');

      if (type === 'benefits') {
        content.innerHTML = `
          <ul class="space-y-4 ">
            <li class="flex items-center gap-3"><span class="text-[#0f8740]">✅</span> Up to ₹10 Lakhs</li>
            <li class="flex items-center gap-3"><span class="text-[#0f8740]">✅</span> Instant Approval</li>
            <li class="flex items-center gap-3"><span class="text-[#0f8740]">✅</span> Zero Hidden Charges</li>
            <li class="flex items-center gap-3"><span class="text-[#0f8740]">✅</span> No Collateral Required</li>
            <li class="flex items-center gap-3"><span class="text-[#0f8740]">✅</span> Flexible Repayment</li>
          </ul>`;
      } else if (type === 'works') {
        content.innerHTML = `
          <div class="space-y-8">
            <div class="flex gap-6">
              <div class="w-12 h-12 rounded-2xl bg-[#0370b5] text-white flex items-center justify-center font-bold text-xl">1</div>
              <div><strong>Apply Online</strong><p class="text-gray-600">Fill simple form in 2 minutes</p></div>
            </div>
            <div class="flex gap-6">
              <div class="w-12 h-12 rounded-2xl bg-[#0370b5] text-white flex items-center justify-center font-bold text-xl">2</div>
              <div><strong>Upload Documents</strong><p class="text-gray-600">Minimal KYC required</p></div>
            </div>
            <div class="flex gap-6">
              <div class="w-12 h-12 rounded-2xl bg-[#0370b5] text-white flex items-center justify-center font-bold text-xl">3</div>
              <div><strong>Get Money</strong><p class="text-gray-600">Disbursal in minutes</p></div>
            </div>
          </div>`;
      } else if (type === 'terms') {
        content.innerHTML = `<ul class="list-disc pl-6 space-y-3 text-gray-700"><li>Age: 21 - 58 years</li><li>Indian Resident</li><li>Minimum monthly income ₹25,000</li></ul>`;
      } else if (type === 'sell') {
        content.innerHTML = `
          <div class="grid grid-cols-2 gap-4">
            <div class="border border-gray-200 rounded-2xl p-6 hover:border-[#0370b5] transition-colors">Salaried Employees</div>
            <div class="border border-gray-200 rounded-2xl p-6 hover:border-[#0370b5] transition-colors">Self Employed</div>
            <div class="border border-gray-200 rounded-2xl p-6 hover:border-[#0370b5] transition-colors">Business Owners</div>
            <div class="border border-gray-200 rounded-2xl p-6 hover:border-[#0370b5] transition-colors">Professionals</div>
          </div>`;
      }
    };

    // Initialize
    renderProducts();
  </script>