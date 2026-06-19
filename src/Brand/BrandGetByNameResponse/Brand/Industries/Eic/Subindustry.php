<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandGetByNameResponse\Brand\Industries\Eic;

/**
 * Subindustry classification enum.
 */
enum Subindustry: string
{
    case DEFENSE_SYSTEMS_MILITARY_HARDWARE = 'Defense Systems & Military Hardware';

    case AEROSPACE_MANUFACTURING = 'Aerospace Manufacturing';

    case AVIONICS_NAVIGATION_TECHNOLOGY = 'Avionics & Navigation Technology';

    case SUBSEA_NAVAL_DEFENSE_SYSTEMS = 'Subsea & Naval Defense Systems';

    case SPACE_SATELLITE_TECHNOLOGY = 'Space & Satellite Technology';

    case DEFENSE_IT_SYSTEMS_INTEGRATION = 'Defense IT & Systems Integration';

    case SOFTWARE_B2_B = 'Software (B2B)';

    case SOFTWARE_B2_C = 'Software (B2C)';

    case CLOUD_INFRASTRUCTURE_DEV_OPS = 'Cloud Infrastructure & DevOps';

    case CYBERSECURITY = 'Cybersecurity';

    case ARTIFICIAL_INTELLIGENCE_MACHINE_LEARNING = 'Artificial Intelligence & Machine Learning';

    case DATA_INFRASTRUCTURE_ANALYTICS = 'Data Infrastructure & Analytics';

    case HARDWARE_SEMICONDUCTORS = 'Hardware & Semiconductors';

    case FINTECH_INFRASTRUCTURE = 'Fintech Infrastructure';

    case E_COMMERCE_MARKETPLACE_PLATFORMS = 'eCommerce & Marketplace Platforms';

    case DEVELOPER_TOOLS_APIS = 'Developer Tools & APIs';

    case WEB3_BLOCKCHAIN = 'Web3 & Blockchain';

    case XR_SPATIAL_COMPUTING = 'XR & Spatial Computing';

    case BANKING_LENDING = 'Banking & Lending';

    case INVESTMENT_MANAGEMENT_WEALTH_TECH = 'Investment Management & WealthTech';

    case INSURANCE_INSUR_TECH = 'Insurance & InsurTech';

    case PAYMENTS_MONEY_MOVEMENT = 'Payments & Money Movement';

    case ACCOUNTING_TAX_FINANCIAL_PLANNING_TOOLS = 'Accounting, Tax & Financial Planning Tools';

    case CAPITAL_MARKETS_TRADING_PLATFORMS = 'Capital Markets & Trading Platforms';

    case FINANCIAL_INFRASTRUCTURE_APIS = 'Financial Infrastructure & APIs';

    case CREDIT_SCORING_RISK_MANAGEMENT = 'Credit Scoring & Risk Management';

    case CRYPTOCURRENCY_DIGITAL_ASSETS = 'Cryptocurrency & Digital Assets';

    case BNPL_ALTERNATIVE_FINANCING = 'BNPL & Alternative Financing';

    case HEALTHCARE_PROVIDERS_SERVICES = 'Healthcare Providers & Services';

    case PHARMACEUTICALS_DRUG_DEVELOPMENT = 'Pharmaceuticals & Drug Development';

    case MEDICAL_DEVICES_DIAGNOSTICS = 'Medical Devices & Diagnostics';

    case BIOTECHNOLOGY_GENOMICS = 'Biotechnology & Genomics';

    case DIGITAL_HEALTH_TELEMEDICINE = 'Digital Health & Telemedicine';

    case HEALTH_INSURANCE_BENEFITS_TECH = 'Health Insurance & Benefits Tech';

    case CLINICAL_TRIALS_RESEARCH_PLATFORMS = 'Clinical Trials & Research Platforms';

    case MENTAL_HEALTH_WELLNESS = 'Mental Health & Wellness';

    case HEALTHCARE_IT_EHR_SYSTEMS = 'Healthcare IT & EHR Systems';

    case CONSUMER_HEALTH_WELLNESS_PRODUCTS = 'Consumer Health & Wellness Products';

    case ONLINE_MARKETPLACES = 'Online Marketplaces';

    case DIRECT_TO_CONSUMER_DTC_BRANDS = 'Direct-to-Consumer (DTC) Brands';

    case RETAIL_TECH_POINT_OF_SALE_SYSTEMS = 'Retail Tech & Point-of-Sale Systems';

    case OMNICHANNEL_IN_STORE_RETAIL = 'Omnichannel & In-Store Retail';

    case E_COMMERCE_ENABLEMENT_INFRASTRUCTURE = 'E-commerce Enablement & Infrastructure';

    case SUBSCRIPTION_MEMBERSHIP_COMMERCE = 'Subscription & Membership Commerce';

    case SOCIAL_COMMERCE_INFLUENCER_PLATFORMS = 'Social Commerce & Influencer Platforms';

    case FASHION_APPAREL_RETAIL = 'Fashion & Apparel Retail';

    case FOOD_BEVERAGE_GROCERY_E_COMMERCE = 'Food, Beverage & Grocery E-commerce';

    case STREAMING_PLATFORMS_VIDEO_MUSIC_AUDIO = 'Streaming Platforms (Video, Music, Audio)';

    case GAMING_INTERACTIVE_ENTERTAINMENT = 'Gaming & Interactive Entertainment';

    case CREATOR_ECONOMY_INFLUENCER_PLATFORMS = 'Creator Economy & Influencer Platforms';

    case ADVERTISING_ADTECH_MEDIA_BUYING = 'Advertising, Adtech & Media Buying';

    case FILM_TV_PRODUCTION_STUDIOS = 'Film, TV & Production Studios';

    case EVENTS_VENUES_LIVE_ENTERTAINMENT = 'Events, Venues & Live Entertainment';

    case VIRTUAL_WORLDS_METAVERSE_EXPERIENCES = 'Virtual Worlds & Metaverse Experiences';

    case K_12_EDUCATION_PLATFORMS_TOOLS = 'K-12 Education Platforms & Tools';

    case HIGHER_EDUCATION_UNIVERSITY_TECH = 'Higher Education & University Tech';

    case ONLINE_LEARNING_MOO_CS = 'Online Learning & MOOCs';

    case TEST_PREP_CERTIFICATION = 'Test Prep & Certification';

    case CORPORATE_TRAINING_UPSKILLING = 'Corporate Training & Upskilling';

    case TUTORING_SUPPLEMENTAL_LEARNING = 'Tutoring & Supplemental Learning';

    case EDUCATION_MANAGEMENT_SYSTEMS_LMS_SIS = 'Education Management Systems (LMS/SIS)';

    case LANGUAGE_LEARNING = 'Language Learning';

    case CREATOR_LED_COHORT_BASED_COURSES = 'Creator-Led & Cohort-Based Courses';

    case SPECIAL_EDUCATION_ACCESSIBILITY_TOOLS = 'Special Education & Accessibility Tools';

    case GOVERNMENT_TECHNOLOGY_DIGITAL_SERVICES = 'Government Technology & Digital Services';

    case CIVIC_ENGAGEMENT_POLICY_PLATFORMS = 'Civic Engagement & Policy Platforms';

    case INTERNATIONAL_DEVELOPMENT_HUMANITARIAN_AID = 'International Development & Humanitarian Aid';

    case PHILANTHROPY_GRANTMAKING = 'Philanthropy & Grantmaking';

    case NONPROFIT_OPERATIONS_FUNDRAISING_TOOLS = 'Nonprofit Operations & Fundraising Tools';

    case PUBLIC_HEALTH_SOCIAL_SERVICES = 'Public Health & Social Services';

    case EDUCATION_YOUTH_DEVELOPMENT_PROGRAMS = 'Education & Youth Development Programs';

    case ENVIRONMENTAL_CLIMATE_ACTION_ORGANIZATIONS = 'Environmental & Climate Action Organizations';

    case LEGAL_AID_SOCIAL_JUSTICE_ADVOCACY = 'Legal Aid & Social Justice Advocacy';

    case MUNICIPAL_INFRASTRUCTURE_SERVICES = 'Municipal & Infrastructure Services';

    case MANUFACTURING_INDUSTRIAL_AUTOMATION = 'Manufacturing & Industrial Automation';

    case ENERGY_PRODUCTION_OIL_GAS_NUCLEAR = 'Energy Production (Oil, Gas, Nuclear)';

    case RENEWABLE_ENERGY_CLEANTECH = 'Renewable Energy & Cleantech';

    case UTILITIES_GRID_INFRASTRUCTURE = 'Utilities & Grid Infrastructure';

    case INDUSTRIAL_IO_T_MONITORING_SYSTEMS = 'Industrial IoT & Monitoring Systems';

    case CONSTRUCTION_HEAVY_EQUIPMENT = 'Construction & Heavy Equipment';

    case MINING_NATURAL_RESOURCES = 'Mining & Natural Resources';

    case ENVIRONMENTAL_ENGINEERING_SUSTAINABILITY = 'Environmental Engineering & Sustainability';

    case ENERGY_STORAGE_BATTERY_TECHNOLOGY = 'Energy Storage & Battery Technology';

    case AUTOMOTIVE_OE_MS_VEHICLE_MANUFACTURING = 'Automotive OEMs & Vehicle Manufacturing';

    case ELECTRIC_VEHICLES_E_VS_CHARGING_INFRASTRUCTURE = 'Electric Vehicles (EVs) & Charging Infrastructure';

    case MOBILITY_AS_A_SERVICE_MAA_S = 'Mobility-as-a-Service (MaaS)';

    case FLEET_MANAGEMENT = 'Fleet Management';

    case PUBLIC_TRANSIT_URBAN_MOBILITY = 'Public Transit & Urban Mobility';

    case AUTONOMOUS_VEHICLES_ADAS = 'Autonomous Vehicles & ADAS';

    case AFTERMARKET_PARTS_SERVICES = 'Aftermarket Parts & Services';

    case TELEMATICS_VEHICLE_CONNECTIVITY = 'Telematics & Vehicle Connectivity';

    case AVIATION_AEROSPACE_TRANSPORT = 'Aviation & Aerospace Transport';

    case MARITIME_SHIPPING = 'Maritime Shipping';

    case FITNESS_WELLNESS = 'Fitness & Wellness';

    case BEAUTY_PERSONAL_CARE = 'Beauty & Personal Care';

    case HOME_LIVING = 'Home & Living';

    case DATING_RELATIONSHIPS = 'Dating & Relationships';

    case HOBBIES_CRAFTS_DIY = 'Hobbies, Crafts & DIY';

    case OUTDOOR_RECREATIONAL_GEAR = 'Outdoor & Recreational Gear';

    case EVENTS_EXPERIENCES_TICKETING_PLATFORMS = 'Events, Experiences & Ticketing Platforms';

    case DESIGNER_LUXURY_APPAREL = 'Designer & Luxury Apparel';

    case ACCESSORIES_JEWELRY_WATCHES = 'Accessories, Jewelry & Watches';

    case FOOTWEAR_LEATHER_GOODS = 'Footwear & Leather Goods';

    case BEAUTY_FRAGRANCE_SKINCARE = 'Beauty, Fragrance & Skincare';

    case FASHION_MARKETPLACES_RETAIL_PLATFORMS = 'Fashion Marketplaces & Retail Platforms';

    case SUSTAINABLE_ETHICAL_FASHION = 'Sustainable & Ethical Fashion';

    case RESALE_VINTAGE_CIRCULAR_FASHION = 'Resale, Vintage & Circular Fashion';

    case FASHION_TECH_VIRTUAL_TRY_ONS = 'Fashion Tech & Virtual Try-Ons';

    case STREETWEAR_EMERGING_LUXURY = 'Streetwear & Emerging Luxury';

    case COUTURE_MADE_TO_MEASURE = 'Couture & Made-to-Measure';

    case NEWS_PUBLISHING_JOURNALISM = 'News Publishing & Journalism';

    case DIGITAL_MEDIA_CONTENT_PLATFORMS = 'Digital Media & Content Platforms';

    case BROADCASTING_TV_RADIO = 'Broadcasting (TV & Radio)';

    case PODCASTING_AUDIO_MEDIA = 'Podcasting & Audio Media';

    case NEWS_AGGREGATORS_CURATION_TOOLS = 'News Aggregators & Curation Tools';

    case INDEPENDENT_CREATOR_LED_MEDIA = 'Independent & Creator-Led Media';

    case NEWSLETTERS_SUBSTACK_STYLE_PLATFORMS = 'Newsletters & Substack-Style Platforms';

    case POLITICAL_INVESTIGATIVE_MEDIA = 'Political & Investigative Media';

    case TRADE_NICHE_PUBLICATIONS = 'Trade & Niche Publications';

    case MEDIA_MONITORING_ANALYTICS = 'Media Monitoring & Analytics';

    case PROFESSIONAL_TEAMS_LEAGUES = 'Professional Teams & Leagues';

    case SPORTS_MEDIA_BROADCASTING = 'Sports Media & Broadcasting';

    case SPORTS_BETTING_FANTASY_SPORTS = 'Sports Betting & Fantasy Sports';

    case FITNESS_ATHLETIC_TRAINING_PLATFORMS = 'Fitness & Athletic Training Platforms';

    case SPORTSWEAR_EQUIPMENT = 'Sportswear & Equipment';

    case ESPORTS_COMPETITIVE_GAMING = 'Esports & Competitive Gaming';

    case SPORTS_VENUES_EVENT_MANAGEMENT = 'Sports Venues & Event Management';

    case ATHLETE_MANAGEMENT_TALENT_AGENCIES = 'Athlete Management & Talent Agencies';

    case SPORTS_TECH_PERFORMANCE_ANALYTICS = 'Sports Tech & Performance Analytics';

    case YOUTH_AMATEUR_COLLEGIATE_SPORTS = 'Youth, Amateur & Collegiate Sports';

    case REAL_ESTATE_MARKETPLACES = 'Real Estate Marketplaces';

    case PROPERTY_MANAGEMENT_SOFTWARE = 'Property Management Software';

    case RENTAL_PLATFORMS = 'Rental Platforms';

    case MORTGAGE_LENDING_TECH = 'Mortgage & Lending Tech';

    case REAL_ESTATE_INVESTMENT_PLATFORMS = 'Real Estate Investment Platforms';

    case LAW_FIRMS_LEGAL_SERVICES = 'Law Firms & Legal Services';

    case LEGAL_TECH_AUTOMATION = 'Legal Tech & Automation';

    case REGULATORY_COMPLIANCE = 'Regulatory Compliance';

    case E_DISCOVERY_LITIGATION_TOOLS = 'E-Discovery & Litigation Tools';

    case CONTRACT_MANAGEMENT = 'Contract Management';

    case GOVERNANCE_RISK_COMPLIANCE_GRC = 'Governance, Risk & Compliance (GRC)';

    case IP_TRADEMARK_MANAGEMENT = 'IP & Trademark Management';

    case LEGAL_RESEARCH_INTELLIGENCE = 'Legal Research & Intelligence';

    case COMPLIANCE_TRAINING_CERTIFICATION = 'Compliance Training & Certification';

    case WHISTLEBLOWER_ETHICS_REPORTING = 'Whistleblower & Ethics Reporting';

    case MOBILE_WIRELESS_NETWORKS_3_G_4_G_5_G = 'Mobile & Wireless Networks (3G/4G/5G)';

    case BROADBAND_FIBER_INTERNET = 'Broadband & Fiber Internet';

    case SATELLITE_SPACE_BASED_COMMUNICATIONS = 'Satellite & Space-Based Communications';

    case NETWORK_EQUIPMENT_INFRASTRUCTURE = 'Network Equipment & Infrastructure';

    case TELECOM_BILLING_OSS_BSS_SYSTEMS = 'Telecom Billing & OSS/BSS Systems';

    case VO_IP_UNIFIED_COMMUNICATIONS = 'VoIP & Unified Communications';

    case INTERNET_SERVICE_PROVIDERS_IS_PS = 'Internet Service Providers (ISPs)';

    case EDGE_COMPUTING_NETWORK_VIRTUALIZATION = 'Edge Computing & Network Virtualization';

    case IO_T_CONNECTIVITY_PLATFORMS = 'IoT Connectivity Platforms';

    case PRECISION_AGRICULTURE_AG_TECH = 'Precision Agriculture & AgTech';

    case CROP_LIVESTOCK_PRODUCTION = 'Crop & Livestock Production';

    case FOOD_BEVERAGE_MANUFACTURING_PROCESSING = 'Food & Beverage Manufacturing & Processing';

    case FOOD_DISTRIBUTION = 'Food Distribution';

    case RESTAURANTS_FOOD_SERVICE = 'Restaurants & Food Service';

    case AGRICULTURAL_INPUTS_EQUIPMENT = 'Agricultural Inputs & Equipment';

    case SUSTAINABLE_REGENERATIVE_AGRICULTURE = 'Sustainable & Regenerative Agriculture';

    case SEAFOOD_AQUACULTURE = 'Seafood & Aquaculture';

    case MANAGEMENT_CONSULTING = 'Management Consulting';

    case MARKETING_ADVERTISING_AGENCIES = 'Marketing & Advertising Agencies';

    case DESIGN_BRANDING_CREATIVE_STUDIOS = 'Design, Branding & Creative Studios';

    case IT_SERVICES_MANAGED_SERVICES = 'IT Services & Managed Services';

    case STAFFING_RECRUITING_TALENT = 'Staffing, Recruiting & Talent';

    case ACCOUNTING_TAX_FIRMS = 'Accounting & Tax Firms';

    case PUBLIC_RELATIONS_COMMUNICATIONS = 'Public Relations & Communications';

    case BUSINESS_PROCESS_OUTSOURCING_BPO = 'Business Process Outsourcing (BPO)';

    case PROFESSIONAL_TRAINING_COACHING = 'Professional Training & Coaching';

    case SPECIALTY_CHEMICALS = 'Specialty Chemicals';

    case COMMODITY_PETROCHEMICALS = 'Commodity & Petrochemicals';

    case POLYMERS_PLASTICS_RUBBER = 'Polymers, Plastics & Rubber';

    case COATINGS_ADHESIVES_SEALANTS = 'Coatings, Adhesives & Sealants';

    case INDUSTRIAL_GASES = 'Industrial Gases';

    case ADVANCED_MATERIALS_COMPOSITES = 'Advanced Materials & Composites';

    case BATTERY_MATERIALS_ENERGY_STORAGE = 'Battery Materials & Energy Storage';

    case ELECTRONIC_MATERIALS_SEMICONDUCTOR_CHEMICALS = 'Electronic Materials & Semiconductor Chemicals';

    case AGROCHEMICALS_FERTILIZERS = 'Agrochemicals & Fertilizers';

    case FREIGHT_TRANSPORTATION_TECH = 'Freight & Transportation Tech';

    case LAST_MILE_DELIVERY = 'Last-Mile Delivery';

    case WAREHOUSE_AUTOMATION = 'Warehouse Automation';

    case SUPPLY_CHAIN_VISIBILITY_PLATFORMS = 'Supply Chain Visibility Platforms';

    case LOGISTICS_MARKETPLACES = 'Logistics Marketplaces';

    case SHIPPING_FREIGHT_FORWARDING = 'Shipping & Freight Forwarding';

    case COLD_CHAIN_LOGISTICS = 'Cold Chain Logistics';

    case REVERSE_LOGISTICS_RETURNS = 'Reverse Logistics & Returns';

    case CROSS_BORDER_TRADE_TECH = 'Cross-Border Trade Tech';

    case TRANSPORTATION_MANAGEMENT_SYSTEMS_TMS = 'Transportation Management Systems (TMS)';

    case HOTELS_ACCOMMODATION = 'Hotels & Accommodation';

    case VACATION_RENTALS_SHORT_TERM_STAYS = 'Vacation Rentals & Short-Term Stays';

    case RESTAURANT_TECH_MANAGEMENT = 'Restaurant Tech & Management';

    case TRAVEL_BOOKING_PLATFORMS = 'Travel Booking Platforms';

    case TOURISM_EXPERIENCES_ACTIVITIES = 'Tourism Experiences & Activities';

    case CRUISE_LINES_MARINE_TOURISM = 'Cruise Lines & Marine Tourism';

    case HOSPITALITY_MANAGEMENT_SYSTEMS = 'Hospitality Management Systems';

    case EVENT_VENUE_MANAGEMENT = 'Event & Venue Management';

    case CORPORATE_TRAVEL_MANAGEMENT = 'Corporate Travel Management';

    case TRAVEL_INSURANCE_PROTECTION = 'Travel Insurance & Protection';

    case CONSTRUCTION_MANAGEMENT_SOFTWARE = 'Construction Management Software';

    case BIM_CAD_DESIGN_TOOLS = 'BIM/CAD & Design Tools';

    case CONSTRUCTION_MARKETPLACES = 'Construction Marketplaces';

    case EQUIPMENT_RENTAL_MANAGEMENT = 'Equipment Rental & Management';

    case BUILDING_MATERIALS_PROCUREMENT = 'Building Materials & Procurement';

    case CONSTRUCTION_WORKFORCE_MANAGEMENT = 'Construction Workforce Management';

    case PROJECT_ESTIMATION_BIDDING = 'Project Estimation & Bidding';

    case MODULAR_PREFAB_CONSTRUCTION = 'Modular & Prefab Construction';

    case CONSTRUCTION_SAFETY_COMPLIANCE = 'Construction Safety & Compliance';

    case SMART_BUILDING_TECHNOLOGY = 'Smart Building Technology';

    case FOOD_BEVERAGE_CPG = 'Food & Beverage CPG';

    case HOME_PERSONAL_CARE_CPG = 'Home & Personal Care CPG';

    case CPG_ANALYTICS_INSIGHTS = 'CPG Analytics & Insights';

    case DIRECT_TO_CONSUMER_CPG_BRANDS = 'Direct-to-Consumer CPG Brands';

    case CPG_SUPPLY_CHAIN_DISTRIBUTION = 'CPG Supply Chain & Distribution';

    case PRIVATE_LABEL_MANUFACTURING = 'Private Label Manufacturing';

    case CPG_RETAIL_INTELLIGENCE = 'CPG Retail Intelligence';

    case SUSTAINABLE_CPG_PACKAGING = 'Sustainable CPG & Packaging';

    case BEAUTY_COSMETICS_CPG = 'Beauty & Cosmetics CPG';

    case HEALTH_WELLNESS_CPG = 'Health & Wellness CPG';
}
