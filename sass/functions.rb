require 'sass'

module Sass::Script::Functions
  def to_hex(color)
    if color.to_s == "transparent"
      return Sass::Script::String.new("#00000000")
    end
    # Convert to hex values
    rgba = Array.new(color.rgb)
    rgba.push((color.alpha * 255).to_i)
    red, green, blue, alpha = rgba.map { |num| num.to_s(16).rjust(2, '0') }
    return Sass::Script::String.new("##{alpha}#{red}#{green}#{blue}")
  end
end